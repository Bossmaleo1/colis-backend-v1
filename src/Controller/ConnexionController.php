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

                $response = new Response(json_encode(array('succes' => 1
                ,'id' => $user->getId()
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
                ,'active' => $user->getActive()
                ,'telephone' => $user->getTelephone())));
            //$response = new Response(json_encode(array('succes' => 1)));
        }else
        {
            $response = new Response(json_encode(array('succes' => 0)));
        }


        /*$response = new Response(json_encode($response));*/
        /*$response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');*/


        //$response = new Response(json_encode(array("succes"=>142)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }


    public function CreateUser(Request $request){

        $em = $this->getDoctrine()->getManager();

        $nom = $request->query->get('nom');
        $prenom = $request->query->get('prenom');
        $email= $request->query->get('email');
        $date_naissance = $request->query->get('date');
        $sexe = $request->query->get('sexe');
        $password = $request->query->get('password');
        $code = $request->query->get('codedevalidation');
        $user = new Users();
        $user->setActive(1);
        $user->setDatenaissance(new \DateTime($date_naissance));
        $user->setEmail($email);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setMotdepasse(sha1($password));
        $user->setSexe($sexe);
        $user->setPhoto('');
        $user->setLangue('');
        $user->setKeypush('');
        $user->setEtat('');
        $user->setPays('');
        $user->setVille('');
        $user->setOnline(1);
        $user->setCodeActivation($code);
        $user->setTelephone('');

        $em->persist($user);
        $em->flush();
        $response = new Response(json_encode(array('succes' => 1
        ,'id' => $user->getId()
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
        ,'online' => $user->getOnline()
        ,'active' => $user->getActive())));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function updatelibelleuserphoto(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $id_user = $request->query->get('id_user');
        $libelle_photo = $request->query->get('libelle_photo');
        $user = $em->getRepository('App\Entity\Users')->find($id_user);
        $user->setPhoto($libelle_photo);
        $em->persist($user);
        $em->flush();

        $response = new Response(json_encode(array('succes' => 1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function UpdateKeyPush(Request $request){
        $id_user = $request->query->get('ID');
        $keypush = $request->query->get('PUSHKEY');

        $em = $this->getDoctrine()->getManager();
        $User = $em->getRepository('App\Entity\Users')->find($id_user);
        $User->setKeypush($keypush);
        $em->persist($User);
        $em->flush();
        $response = new Response(json_encode(array('succes' => 1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

}