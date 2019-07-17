<?php
namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\VilleAnnonce;
use App\Entity\Users;
use App\Entity\Avis;
use App\Entity\ValidationAnnonce;
use App\Entity\Notification;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Carbon\Carbon;

class HomeController extends AbstractController
{

    public function SearchTown(Request $request) {

        $libelle_town = $request->query->get('town');
        $em = $this->getDoctrine()->getManager();
        $searchtownRepository = $em->getRepository('App\Entity\Aeroportinternationnal');
        $listsearchtown = $searchtownRepository->SearchTowns($libelle_town);
        $result = array();

        foreach ($listsearchtown as $aeroportinternational) {
            $temp = array();
            $temp["ID"] = $aeroportinternational->getId();
            $temp["Libelle"] = $aeroportinternational->getVille()->getLibelle()." (".$aeroportinternational->getVille()->getPays()->getLibelle()."(".$aeroportinternational->getLibelle().",".$aeroportinternational->getCode()."))";
            array_push($result,$temp);
        }


        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public  function InsertAnnonce(Request $request){

        $em = $this->getDoctrine()->getManager();
        $heure_depart = $request->query->get('heure_depart');
        $heure_arrivee = $request->query->get('heure_arrivee');
        $nom_kilo_max = $request->query->get('max_kilo');
        $lieux_rdv1 = $request->query->get('lieux_rdv1');
        $lieux_rdv2 = $request->query->get('lieux_rdv2');
        $dateannonce = $request->query->get('dateannonce');
        $dateannonce2 = $request->query->get('dateannonce2');
        $id_users = $request->query->get('id_user');
        $aeroportiddepart = $request->query->get('id_aeroport1');
        $aeroportidarrivee = $request->query->get('id_aeroport2');
        $prix = $request->query->get('prix');

        $user = $em->getRepository('App\Entity\Users')->find($id_users);
        //on cree l'annonce
        $annonce = new Annonce();
        $annonce->setLieuxRdv1($lieux_rdv1);
        $annonce->setLieuxRdv2($lieux_rdv2);
        $annonce->setNombreKilo($nom_kilo_max);
        $annonce->setNombreKilo($nom_kilo_max);
        $annonce->setNombreKilo($nom_kilo_max);
        $annonce->setHeureDepart(new \DateTime($heure_depart)) ;
        $annonce->setHeureArrivee(new \DateTime($heure_arrivee));
        $annonce->setDateannonce(new \DateTime($dateannonce));
        $annonce->setDateannonce2(new \DateTime($dateannonce2));
        $annonce->setIdAeroportDepart($aeroportiddepart);
        $annonce->setIdAeroportArrivee($aeroportidarrivee);
        $annonce->setPrix($prix);
        $annonce->setDate(new \DateTime());
        $annonce->setUsers($user);
        $em->persist($annonce);
        $em->flush();


        $response = new Response(json_encode(array("succes"=>1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }





    public function Rechercher(Request $request) {
        $result = array();
        $em = $this->getDoctrine()->getManager();
        $id_ville_depart = $request->query->get('lieux_depart');
        $id_ville_arrivee = $request->query->get('lieux_arrivee');
        $datevoyage = $request->query->get('date_voyage');

        $AnnonceRepository = $this->get('doctrine')->getRepository(Annonce::class);
        $annoncelist = $AnnonceRepository->findBy(
            array('id_aeroport_depart' => $id_ville_depart,'id_aeroport_arrivee' => $id_ville_arrivee,'dateannonce' => new \DateTime($datevoyage)),
            array(),
            100,
            0
        );

        if($annoncelist){

            foreach($annoncelist as $annonce_item)
            {
                $array_temp = array();
                $aeroportdepart = $em->getRepository('App\Entity\Aeroportinternationnal')->find($id_ville_depart);
                $aeroportarrivee = $em->getRepository('App\Entity\Aeroportinternationnal')->find($id_ville_arrivee);
                $array_temp['ID'] = $annonce_item->getId();
                $array_temp['ID_USER'] = $annonce_item->getUsers()->getId();
                $array_temp['PHOTO_USER'] = $annonce_item->getUsers()->getPhoto();
                $array_temp['NOM_USER'] = $annonce_item->getUsers()->getPrenom()." ".$annonce_item->getUsers()->getNom();
                $array_temp['PHONE_USER'] = $annonce_item->getUsers()->getTelephone();
				$array_temp['KEYPUSH'] = $annonce_item->getUsers()->getKeypush();
                $array_temp['DATE_ANNONCE'] = Carbon::parse($annonce_item->getDate())->locale('fr_FR')->diffForHumans();
                $temp_date = explode(" ", $annonce_item->getDateannonce()->format('Y-m-d H:i:s'))[0];
                $temp_date2 = explode(" ", $annonce_item->getDateannonce2()->format('Y-m-d H:i:s'))[0];
                $array_temp['DATE_ANNONCE_VOYAGE'] = explode("-",$temp_date)[2]."-".explode("-",$temp_date)[1]."-".explode("-",$temp_date)[0];
                $array_temp['DATE_ANNONCE_VOYAGE2'] = explode("-",$temp_date2)[2]."-".explode("-",$temp_date2)[1]."-".explode("-",$temp_date2)[0];
                $array_temp['Prix'] = $annonce_item->getPrix();
                $array_temp['lieux_rdv1'] = $annonce_item->getLieuxRdv1();
                $array_temp['lieux_rdv2'] = $annonce_item->getLieuxRdv2();
                $array_temp['ville_depart'] = $aeroportdepart->getVille()->getLibelle()." (".$aeroportdepart->getVille()->getPays()->getLibelle()."(".$aeroportdepart->getLibelle().",".$aeroportdepart->getCode()."))";
                $array_temp['ville_arrivee'] = $aeroportarrivee->getVille()->getLibelle()." (".$aeroportarrivee->getVille()->getPays()->getLibelle()."(".$aeroportarrivee->getLibelle().",".$aeroportarrivee->getCode()."))";
                $array_temp['heure_depart'] = explode(" ", $annonce_item->getHeureDepart()->format('Y-m-d H:i:s'))[1];
                $array_temp['heure_darrivee'] = explode(" ", $annonce_item->getHeureArrivee()->format('Y-m-d H:i:s'))[1];
                $array_temp['nombre_kilo'] = $annonce_item->getNombreKilo();
                array_push($result,$array_temp);
            }

        }


        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function ValidationAnnonce(Request $request) {



        $response = new Response(json_encode(array('succes'=>1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function InsertValidation(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $nombre_de_kilo_max = $request->get('nombrekilo');
        $description_colis = $request->get('description');
        $id_annonce = $request->get('id_annonce');
        $id_emmetteur = $request->get('id_emmetteur');
        $Libelle = $request->get('libelle');


        $annonce = $em->getRepository('App\Entity\Annonce')->find($id_annonce);


        //insertion de la validation
        $validation = new  ValidationAnnonce();
        $validation->setDateValidation(new \DateTime());
        $validation->setNombreDeKiloMax($nombre_de_kilo_max);
        $validation->setStatutValidation(0);
        $validation->setAnnonce($annonce);
        $validation->setDescriptionColis($description_colis);
        $validation->setIdEmmeteur($id_emmetteur);
        $em->persist($validation);
        $em->flush();

        //insertion de la notification
        $notification = new Notification();
        $notification->setIDLibelle($validation->getId());
        $notification->setIDType(0);
        $notification->setLibelle($Libelle);
        $notification->setEtat(0);
        $notification->setIDUser($annonce->getUsers()->getId());
        $notification->setDate(new \DateTime());
        $notification->setIdEmmetteur($id_emmetteur);
        $em->persist($notification);
        $em->flush();
        $response = new Response(json_encode(array('succes'=>1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function AfficherValidation(Request $request) {

        $resultat = array();
        $em = $this->getDoctrine()->getManager();
        $id_user = $request->get('ID_USER');
        $validationAnnonceRepository = $em->getRepository('App\Entity\ValidationAnnonce');
        $listevalidationannonce = $validationAnnonceRepository->finAllValidationByUser($id_user);

        foreach($listevalidationannonce as $validation) {
            $array_temp = array();
            $array_temp['id'] =  $validation->getId();
            $array_temp['description'] =  $validation->getDescriptionColis();
            $array_temp['date_validation'] = Carbon::parse($validation->getDateValidation())->locale('fr_FR')->diffForHumans();
            $array_temp['statut_validation'] =  $validation->getStatutValidation();
            $array_temp['nombre_kilo'] = $validation->getNombreDeKiloMax();
            $array_temp['id_emmeteur'] = $validation->getIdEmmeteur();
			$user = $em->getRepository('App\Entity\Users')->find($validation->getIdEmmeteur());
            $array_temp['id_annonce'] = $validation->getAnnonce()->getId();
			$array_temp['nom_emmeteur'] = $user->getNom();
            $array_temp['prenom_emmeteur'] = $user->getPrenom();
            $array_temp['photo_emmeteur'] = $user->getPhoto();
            array_push($resultat,$array_temp);
        }

        $response = new Response(json_encode($resultat));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }


    public function AfficherNotification(Request $request) {

        $resultat = array();
        $id_user = $request->get('ID_USER');
        $em = $this->getDoctrine()->getManager();
        $notificationRepository = $this->get('doctrine')->getRepository(Notification::class);
        $notificationlist = $notificationRepository->findBy(
            array('ID_User' => $id_user),
            array(),
            100,
            0
        );

        foreach($notificationlist as $notification_item)
        {
            //$user = $em->getRepository('App\Entity\Users')->find($notification_item->getIdEmmetteur());
            $array_temp = array();
            $array_temp['etat'] =  $notification_item->getEtat();
            $array_temp['id_libelle'] = $notification_item->getIDLibelle();
            $array_temp['id_type'] = $notification_item->getIDType();
            /*$array_temp['id'] =  $notification_item->getId();
            $array_temp['ID_Libelle'] =  $notification_item->getIDLibelle();
            $array_temp['ID_Type'] = $notification_item->getIDType();
            $array_temp['Libelle'] =  $notification_item->getLibelle();
            $array_temp['Etat'] = $notification_item->getEtat();
            $array_temp['ID_User'] = $notification_item->getIDUser();
            $array_temp['nom_emmeteur'] = $user->getNom();
            $array_temp['prenom_emmeteur'] = $user->getPrenom();
            $array_temp['photo_emmeteur'] = $user->getPhoto();
            $array_temp['date'] = Carbon::parse($notification_item->getDate())->locale('fr_FR')->diffForHumans();*/
            if($notification_item->getIDType()===0)
            {
                $validation = $em->getRepository('App\Entity\ValidationAnnonce')->find($notification_item->getIDLibelle());
                $array_temp['id'] =  $validation->getId();
                $array_temp['description'] =  $validation->getDescriptionColis();
                $array_temp['date_validation'] = Carbon::parse($validation->getDateValidation())->locale('fr_FR')->diffForHumans();
                $array_temp['statut_validation'] =  $validation->getStatutValidation();
                $array_temp['nombre_kilo'] = $validation->getNombreDeKiloMax();
                $array_temp['id_emmeteur'] = $validation->getIdEmmeteur();
                $user = $em->getRepository('App\Entity\Users')->find($validation->getIdEmmeteur());
                $array_temp['id_annonce'] = $validation->getAnnonce()->getId();
                $array_temp['nom_emmeteur'] = $user->getNom();
                $array_temp['prenom_emmeteur'] = $user->getPrenom();
                $array_temp['photo_emmeteur'] = $user->getPhoto();
                $array_temp['phone_emmeteur'] = $user->getTelephone();
                $array_temp['keypush_emmeteur'] = $user->getKeypush();
            } else {

            }
            array_push($resultat,$array_temp);
        }

        $response = new Response(json_encode($resultat));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }


    public function AfficherCountNotification(Request $request) {
        $id_user = $request->get('ID_USER');
        $notificationRepository = $this->get('doctrine')->getRepository(Notification::class);
        $notificationlist = $notificationRepository->findBy(
            array('ID_User' => $id_user,'Etat' => 0),
            array(),
            100,
            0
        );
        $countnotification = sizeof($notificationlist);

        $response = new Response(json_encode(array('count_notification'=>$countnotification)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function MarquerNotificationLu(Request $request)
    {
        $id_user = $request->get('ID_USER');
        $notificationRepository = $this->get('doctrine')->getRepository(Notification::class);
        $em = $this->getDoctrine()->getManager();
        $notificationlist = $notificationRepository->findBy(
            array('ID_User' => $id_user,'Etat' => 0),
            array(),
            100,
            0
        );

        foreach($notificationlist as $notification_item)
        {
            $notification = $em->getRepository('App\Entity\Notification')->find($notification_item->getId());
            $notification->setEtat(1);
            $em->persist($notification);
            $em->flush();
        }

        $response = new Response(json_encode(array('succes'=>1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function ValidationAnnulationDemandeExpedition(Request $request) {
        $id_validation = $request->get('id_validation');
        $id_emmeteur = $request->get('id_emmeteur');
        $Libelle = $request->get('message');
        $etat = $request->get('etat');
        $em = $this->getDoctrine()->getManager();
        $validation = $em->getRepository('App\Entity\ValidationAnnonce')->find($id_validation);
        //si la personne accepter la demande d'envoie
        if ($etat == 1) {
            $validation->setStatutValidation(1);
            // si la personne vient d'annuler une demande
        } else if ($etat == 2) {
            $validation->setStatutValidation(2);
        }
        $em->persist($validation);
        $em->flush();

        //insertion de la notification
        $notification = new Notification();
        $notification->setIDLibelle($validation->getId());
        $notification->setIDType(1);// 1 lorsqu'il s'agit de la notification sur un avis
        $notification->setLibelle($Libelle);
        $notification->setEtat(0);
        $notification->setIDUser($validation->getIdEmmeteur());
        $notification->setDate(new \DateTime());
        $notification->setIdEmmetteur($id_emmeteur);
        $em->persist($notification);
        $em->flush();

        $response = new Response(json_encode(array('succes'=>1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

    public function InsertAvis(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $note = $request->query->get('note');
        $commentaire = $request->get('commentaire');
        $id_annonce = $request->get('id_annonce');
        $id_emmeteur = $request->get('id_emmeteur');
        $Libelle = $request->get('message');


        $annonce = $em->getRepository('App\Entity\Annonce')->find($id_annonce);
        //on ajoute un avis
        $avis = new Avis();
        $avis->setNote($note);
        $avis->setCommentaire($commentaire);
        $avis->setIdEmmetteur($id_emmeteur);
        $avis->setAnnonce($annonce);
        $avis->setDate(new \DateTime());
        $em->persist($avis);
        $em->flush();
        //insertion de la notification
        $notification = new Notification();
        $notification->setIDLibelle($avis->getId());
        $notification->setIDType(1);// 1 lorsqu'il s'agit de la notification sur un avis
        $notification->setLibelle($Libelle);
        $notification->setEtat(0);
        $notification->setIDUser($annonce->getUsers()->getId());
        $notification->setDate(new \DateTime());
        $notification->setIdEmmetteur($id_emmeteur);
        $em->persist($notification);
        $em->flush();


        $response = new Response(json_encode(array("succes"=>1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }


    public function AfficherAvis(Request $request)
    {
        $resultat = array();
        $em = $this->getDoctrine()->getManager();
        $id_user = $request->get('ID_USER');
        $avisRepository = $em->getRepository('App\Entity\Avis');
        $listeavis = $avisRepository->finAllAvisByUser($id_user);

        foreach($listeavis as $avis) {
            $user = $em->getRepository('App\Entity\Users')->find($avis->getIdEmmetteur());
            $array_temp = array();
            $array_temp['id'] =  $avis->getId();
            $array_temp['note'] =  $avis->getNote();
            $array_temp['commentaire'] = $avis->getCommentaire();
            $array_temp['date'] = Carbon::parse($avis->getDate())->locale('fr_FR')->diffForHumans();
            $array_temp['id_emmeteur'] = $avis->getIdEmmetteur();
            $array_temp['id_annonce'] = $avis->getAnnonce()->getId();
            $array_temp['nom_emmeteur'] = $user->getNom();
            $array_temp['prenom_emmeteur'] = $user->getPrenom();
            $array_temp['photo_emmeteur'] = $user->getPhoto();
            array_push($resultat,$array_temp);
        }

        $response = new Response(json_encode($resultat));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }


}