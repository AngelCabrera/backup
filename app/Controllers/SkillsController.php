<?php

namespace App\Controllers;

use App\Models\Skill;

class SkillsController extends BaseController
{
  public function getAddSkillsAction()
  {
    return $this->renderHTML('addSkill.twig');
  }

  public function postAddSkillsAction($request)
  {
    $data = $request->getParsedBody();
    $skill = new Skill();
    $skill->title = $data['title'];
    $skill->category = $data['category'];
    $skill->save();
    $alert = 'Habilidad añadida con éxito';
    return $this->renderHTML('addSkill.twig', ['alert' => $alert]);
  }
}
