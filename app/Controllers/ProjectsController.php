<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\ProjectTechnology;
use Respect\Validation\Validator as v;
use Aura\Router\Exception;

class ProjectsController extends BaseController
{
    public function getAddProjectAction()
    {
        return $this->renderHTML('addProject.twig');
    }

    public function postAddProjectAction($request)
    {
        $data = $request->getParsedBody();
        $files = $request->getUploadedFiles();
        $thumbnail = $files['thumbnail'];
        if ($thumbnail->getError() == UPLOAD_ERR_OK) {
            $filename = $thumbnail->getClientFileName();
            $path = "storage/uploads/" . $filename;
            $thumbnail->moveTo($path);
        } else {
            echo "Error on upload";
        }

        $project = new Project();
        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->image = $filename;
        try {
            $project->save();
        } catch (Exception $e) {
            $alert = "Error: " . $e->getMessage();
        }

        $technologies = [];
        for ($i = 1; $i < 4; $i++) {
            $name = "technology" . $i;
            if ($data[$name] != null)
                $technologies[$i - 1] = $data[$name];
        }

        $project_id = Project::where('title', $data['title'])->first()->id;

        foreach ($technologies as $technology) {
            $projectTecnology = new ProjectTechnology();
            $projectTecnology->title = strtoupper($technology);
            $projectTecnology->project_id = (int)$project_id;
            $projectTecnology->save();
            $alert = "Proyecto guardado con éxito";
        }

        return $this->renderHTML('addProject.twig', ['alert' => $alert]);
    }
}
