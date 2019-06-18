<?php

namespace App\Controllers;

use App\Models\Job;
use App\Models\JobAchievement;
use Respect\Validation\Validator as v;
use Symfony\Component\Config\Definition\Exception\Exception;

class JobsController extends BaseController
{
    public function getAddJobAction()
    {
        return $this->renderHTML('addJob.twig');
    }

    public function postAddJobAction($request)
    {
        $data = $request->getParsedBody();

        $stringValidator = v::stringType()
            ->notEmpty()
            ->length(5, null);
        $numValidator = v::numeric()->length(0, 3);

        if (
            $stringValidator->validate($data['title'])
            && $stringValidator->validate($data['description'])
            && $numValidator->validate($data['months'])
        ) {
            $job = new Job();
            $job->title = $data['title'];
            $job->description = $data['description'];
            $job->months = $data['months'];

            try {
                $job->save();
            } catch (Exception $e) {
                $alert = 'Error: ' . $e->getMessage() . "\n";
            }
        } else
            echo 'Imposible guardar, verifica que los datos cumplan con los requerimientos';

        $achievements = [];
        for ($i = 1; $i < 4; $i++) {
            $name = "achievement" . $i;
            if ($data[$name] != null)
                $achievements[$i - 1] = $data[$name];
        }

        $job_id = Job::where('title', $data['title'])->first()->id;

        foreach ($achievements as $achievement) {
            $achieve = new JobAchievement;
            $achieve->description = $achievement;
            $achieve->job_id = $job_id;
            try {
                $achieve->save();
                $alert = "Guardado en la base de datos con éxito";
            } catch (Exception $e) {
                $alert = 'Error: ' . $e->getMessage() . "\n";
            }
        }
        return $this->renderHTML('addJob.twig', ['alert' => $alert]);
    }
}
