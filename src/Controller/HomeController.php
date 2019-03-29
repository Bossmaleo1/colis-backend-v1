<?php
/**
 * Created by Wazzaby Project.
 * User: Sidney Regis MALEO MAYEKO
 * Date: 1/20/2019
 * Time: 6:36 PM
 */

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Messagepublic;
use App\Entity\PhotoMessagepublic;
use App\Entity\Problematique;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Carbon\Carbon;

class HomeController extends AbstractController
{
    public function SaveMessagePublic(Request $request)
    {
        $id = $request->query->get('ID');
        $id_problematique = $request->query->get('id_problematique');
        $libelle = $request->query->get('libelle');
        $insertion_avec_image = $request->query->get('etat');
        $em = $this->getDoctrine()->getManager();
        //on recupere l'utilisateur
        $user = $em->getRepository('App\Entity\Users')->find($id);
        $problematique = $em->getRepository('App\Entity\Problematique')->find($id_problematique);

        if ($insertion_avec_image==1) {
            $message = new Messagepublic();
        }else {
            $message = $em->getRepository('App\Entity\Messagepublic')->find($request->query->get('id_message_public'));
        }

        $message->setUsers($user);
        $message->setDatetime(new \DateTime());
        $message->setProblematique($problematique);
        $message->setLibelle($libelle);

        $em->persist($message);
        $em->flush();


        $response = new Response(json_encode(array('succes' => 1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function photomessagepublic(Request $request) {

        $nom_du_fichier = null;
        $id_problematique = $request->query->get('id_problematique');
        $id_user = $request->query->get('id_user');
        $id_photo;
        $file_extension = $request->query->get('file_extension');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App\Entity\Users')->find($id_user);
        $problematique = $em->getRepository('App\Entity\Problematique')->find($id_problematique);
        $message = new Messagepublic();
        $message->setUsers($user);
        $message->setProblematique($problematique);
        $message->setDatetime(new \DateTime());
        $message->setLibelle(" ");
        $photomessagepublic = new PhotoMessagepublic();
        $em->persist($message);
        $em->flush();
        $PhotomessagepublicRepository = $this->get('doctrine')->getRepository(PhotoMessagepublic::class);
        $photomessagepublicslist = $PhotomessagepublicRepository->findBy(
            array(),
            array('id'=>'DESC'),
            1,
            0
        );

        if($photomessagepublicslist) {
            foreach ($photomessagepublicslist as $photoObject) {
                $numero_nom = intval($photoObject->getId());
                $numero_nom++;
                $nom_du_fichier = 'photostatus_'.$numero_nom;
                //on recupere l'utilisateur
                $photomessagepublic->setLibelle($nom_du_fichier);
                $photomessagepublic->setExtension($file_extension);
                $photomessagepublic->setMessagepublic($message);
            }
        } else {
            $nom_du_fichier = 'photostatus_1';
            //on recupere l'utilisateur
            $photomessagepublic->setLibelle($nom_du_fichier);
            $photomessagepublic->setExtension($file_extension);
            $photomessagepublic->setMessagepublic($message);
        }

        $em->persist($photomessagepublic);
        $em->flush();

        $response = new Response(json_encode(array('name_file' => $nom_du_fichier,'id_messagepublic' =>$message->getId() ,'ID_photo'=>$photomessagepublic->getId())));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function deletephotomessagepublic(Request $request) {
        $ID = intval($request->query->get('ID_photo'));
        $ID_MESSAGEPUBLIC = intval($request->query->get('ID'));
        $em = $this->getDoctrine()->getManager();
        $photomessagepublic = $this->get('doctrine')->getRepository(PhotoMessagepublic::class);;
        $photomessagepublic = $photomessagepublic->find($ID);

        $messagepublic = $this->get('doctrine')->getRepository(Messagepublic::class);;
        $messagepublic = $messagepublic->find($ID_MESSAGEPUBLIC);

        $em->remove($photomessagepublic);
        $em->flush();

        $em->remove($messagepublic);
        $em->flush();

        $response = new Response(json_encode(array('succes' => 1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;

    }

    public function displayPublicMessage(Request $request) {
        $id_problematique = intval($request->query->get('id_problematique'));
        $array_message_public = array();
        $MessagePublicRepository = $this->get('doctrine')->getRepository(Messagepublic::class);

        $problematique = $this->get('doctrine')->getRepository(Problematique::class);
        $problematique = $problematique->find($id_problematique);

        $messagepublicslist = $MessagePublicRepository->findBy(
            array('problematique'=>$problematique),
            array('id'=>'DESC'),
            20,
            0
        );

        foreach ($messagepublicslist as $messagepublicobject) {
           $array_temp = array();
           $array_temp['id'] = $messagepublicobject->getId();
           $array_temp['name'] = $messagepublicobject->getUsers()->getPrenom().' '.$messagepublicobject->getUsers()->getNom();
           $array_temp['updated'] = Carbon::parse($messagepublicobject->getDatetime())->locale('fr_FR')->diffForHumans();

           if(empty($messagepublicobject->getUsers()->getPhoto()))
           {
               $array_temp['user_photo'] = '../../Icons/ic_profile_colorier.png';
           }else {
               $array_temp['user_photo'] = $messagepublicobject->getUsers()->getPhoto();
           }

           $array_temp['status_text_content'] = $messagepublicobject->getLibelle();
           $PhotoMessagepublicRepository = $this->get('doctrine')->getRepository(PhotoMessagepublic::class);
           $PhotoMessagepubliclist = $PhotoMessagepublicRepository->findBy(
                array('messagepublic' => $messagepublicobject),
                array(),
                1,
                0
            );


           if ($PhotoMessagepubliclist) {
                $array_temp['etat_photo_status'] = 'block';
                foreach($PhotoMessagepubliclist as $photomessagepublicobject)
                {
                    $array_temp['status_photo'] = 'http://wazzaby.com/uploads/upload/'.$photomessagepublicobject->getLibelle().'.'.$photomessagepublicobject->getExtension();
                }
           } else {
                $array_temp['etat_photo_status'] = 'none';
                $array_temp['status_photo'] = '';
           }

           array_push($array_message_public,$array_temp);


        }

        $response = new Response(json_encode($array_message_public));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function insertUsers(Request $request) {
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


    public function ProbElasticSearchService(Request $request) {

        $libelle_catprob = $request->query->get('libelle_catprob');

        $em = $this->getDoctrine()->getManager();
        $catprobRepository = $em->getRepository('App\Entity\Categorieprob');
        $listcatprob = $catprobRepository->SearchCatProb($libelle_catprob);
        $result = array();

        foreach ($listcatprob as $catprob) {
            $temp = array();
            $temp["ID"] = $catprob->getId();
            $temp["Libelle"] = $catprob->getLibelle();
            array_push($result,$temp);
        }

        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function displayAllcatprob(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $catprobRepository = $em->getRepository('App\Entity\Categorieprob');

        $listcatprob = $catprobRepository->findAllCatProb();
        $result = array();

        foreach ($listcatprob as $catprob) {
            $temp = array();
            $temp["ID"] = $catprob->getId();
            $temp["Libelle"] = $catprob->getLibelle();
            array_push($result,$temp);
        }

        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function displayproblematique(Request $request)
    {
        $id = $request->query->get('ID');
        $em = $this->getDoctrine()->getManager();
        $problematiqueRepository = $em->getRepository('App\Entity\Problematique');

        $listprob = $problematiqueRepository->findProblematique($id);
        $result = array();

        foreach ($listprob as $prob) {
            $temp = array();
            $temp["ID"] = $prob->getId();
            $temp["Libelle"] = $prob->getLibelle();
            array_push($result,$temp);
        }

        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function searchproblematique(Request $request)
    {
        $id = $request->query->get('ID');
        $libelle = $request->query->get('libelle');
        $em = $this->getDoctrine()->getManager();
        $problematiqueRepository = $em->getRepository('App\Entity\Problematique');

        $listprob = $problematiqueRepository->SearchCatProb($libelle,$id);
        $result = array();

        foreach ($listprob as $prob) {
            $temp = array();
            $temp["ID"] = $prob->getId();
            $temp["Libelle"] = $prob->getLibelle();
            array_push($result,$temp);
        }

        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function changeproblematique(Request $request)
    {
        $id = $request->query->get('ID');
        $idprob = $request->query->get('ID_prob');
        $em = $this->getDoctrine()->getManager();
        //on recupere l'utilisateur
        $user = $em->getRepository('App\Entity\Users')->find($id);
        $problematique = $em->getRepository('App\Entity\Problematique')->find($idprob);
        $user->setProblematique($problematique);
        $em->persist($user);
        $em->flush();

        $response = new Response(json_encode(array('succes' => 1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function addComment(Request $request)
    {
        $id_messagepublic = $request->query->get('id_messagepublic');
        $id_user = $request->query->get('id_user');
        $libelle = $request->query->get('libelle_comment');
        $em = $this->getDoctrine()->getManager();
        $messagepublic = $em->getRepository('App\Entity\Messagepublic')->find($id_messagepublic);
        $user = $em->getRepository('App\Entity\Users')->find($id_user);
        $comment = new Commentaire();
        $comment->setMessagepublic($messagepublic);
        $comment->setUser($user);
        $comment->setLibelle($libelle);
        $comment->setDatetime(new \DateTime());
        $em->persist($comment);
        $em->flush();

        $response = new Response(json_encode(array('succes' => 1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function displayComment(Request $request)
    {
        $id_messagepublic = $request->query->get('id_messagepublic');
        $array_comments = array();
        $em = $this->getDoctrine()->getManager();
        $messagepublic = $em->getRepository('App\Entity\Messagepublic')->find($id_messagepublic);
        $CommentsRepository = $this->get('doctrine')->getRepository(Commentaire::class);

        $commentslist = $CommentsRepository->findBy(
            array('messagepublic'=>$messagepublic),
            array('id'=>'DESC'),
            20,
            0
        );

        foreach ($commentslist as $comments) {
            $array_temp = array();
            $array_temp['id'] = $comments->getId();
            $array_temp['name'] = $comments->getUser()->getPrenom().' '.$comments->getUser()->getNom();
            $array_temp['updated'] = Carbon::parse($comments->getDatetime())->locale('fr_FR')->diffForHumans();
            $array_temp['user_photo'] = 'http://wazzaby.com/uploads/photo_de_profil/'.$comments->getUser()->getPhoto();
            $array_temp['status_text_content'] = $comments->getLibelle();

            array_push($array_comments,$array_temp);
        }

        $response = new Response(json_encode($array_comments));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }



}