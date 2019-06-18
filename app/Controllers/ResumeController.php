<?php

namespace App\Controllers;

use App\Models\Resume;

class ResumeController extends BaseController
{
    public function getAddResumeAction()
    {
        return $this->renderHTML('addResume.twig');
    }

    public function postAddResumeAction($request)
    {
        $data = $request->getParsedBody();
        $resume = new Resume();
        $resume->content = $data['content'];
        $resume->save();
        $alert = 'Resumen añadido con éxito';
        return $this->renderHTML('addResume.twig', ['alert' => $alert]);
    }
}
