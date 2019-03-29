<?php
/**
 * Created by Wazzaby Project.
 * User: Sidney Regis MALEO MAYEKO
 * Date: 1/6/2019
 * Time: 4:21 PM
 */

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnexionController extends AbstractController
{

    public function connexion(Request $request)
    {
        $email = $request->query->get('email');
        $password = $request->query->get('password');
        /*$email="bossprogrammaleo@gmail.com";
        $password = "maleo9393";*/
        $password_sha1 = sha1($password);


        $UserRepository = $this->get('doctrine')->getRepository(Users::class);
        $userslist = $UserRepository->findBy(
            array('email' => $email,'motdepasse' => $password_sha1),
            array(),
            1,
            0
        );


        if($userslist)
        {
            foreach($userslist as $user_item)
            {
                $user = $user_item;
            }

            if($user->getProblematique())
            {
                $response = new Response(json_encode(array('succes' => 1
                ,'id' => $user->getId()
                ,'id_prob' => $user->getProblematique()->getID()
                ,'libelle_prob' => $user->getProblematique()->getLibelle()
                ,'nom' => $user->getNom()
                ,'prenom' => $user->getPrenom()
                ,'datenaissance' => $user->getDatenaissance()
                ,'sexe' => $user->getSexe()
                ,'photo' => $user->getPhoto()
                ,'email' => $user->getEmail()
                ,'langue' => $user->getLangue()
                ,'etat' => $user->getEtat()
                ,'pays' => $user->getPays()
                ,'ville' => $user->getVille()
                ,'keypush' => $user->getKeypush()
                ,'online' => $user->getOnline()
                ,'active' => $user->getActive())));
            } else {
                $response = new Response(json_encode(array('succes' => 1
                ,'id' => $user->getId()
                ,'id_prob' => 0
                ,'libelle_prob' => ''
                ,'nom' => $user->getNom()
                ,'prenom' => $user->getPrenom()
                ,'datenaissance' => $user->getDatenaissance()
                ,'sexe' => $user->getSexe()
                ,'photo' => $user->getPhoto()
                ,'email' => $user->getEmail()
                ,'langue' => $user->getLangue()
                ,'etat' => $user->getEtat()
                ,'pays' => $user->getPays()
                ,'ville' => $user->getVille()
                ,'keypush' => $user->getKeypush()
                ,'online' => $user->getOnline()
                ,'active' => $user->getActive())));
            }


        }else
        {
            $response = new Response(json_encode(array('succes' => 0)));
        }

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');

        return $response;
    }

}