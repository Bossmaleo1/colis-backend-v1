<?php
namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\VilleAnnonce;
use App\Entity\Users;
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


    public function InsertAvis(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $note = $request->query->get('note');
        $commentaire = $request->query('commentaire');
        $id_annonce = $request->query('id_annonce');
        $id_emmeteur = $request->query('id_emmeteur');
        $id_recepteur = $request->query('id_recepteur');


        $annonce = $em->getRepository('App\Entity\Annonce')->find($id_annonce);
        //on ajoute un avis
        $avis = new Avis();
        $avis->setNote($note);
        $avis->setCommentaire($commentaire);
        $avis->setIdEmmetteur($id_emmeteur);
        $avis->setIdRecepteur($id_recepteur);
        $avis->setAnnonce($annonce);
        $avis->setDate(new \DateTime());
        $em->persist($avis);
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
                $array_temp['DATE_ANNONCE'] = Carbon::parse($annonce_item->getDate())->locale('fr_FR')->diffForHumans();
                $temp_date = explode(" ", $annonce_item->getDateannonce()->format('Y-m-d H:i:s'))[0];
                $array_temp['DATE_ANNONCE_VOYAGE'] = explode("-",$temp_date)[2]."-".explode("-",$temp_date)[1]."-".explode("-",$temp_date)[0];
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

}