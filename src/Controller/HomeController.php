<?php
namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\VilleAnnonce;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        //$result = array();
        $heure_depart = $request->query->get('heure_depart');
        $heure_arrivee = $request->query->get('heure_arrivee');
        $nom_kilo_max = $request->query->get('max_kilo');
        $lieux_rdv1 = $request->query->get('lieux_rdv1');
        $lieux_rdv2 = $request->query->get('lieux_rdv2');
        $dateannonce = $request->query->get('dateannonce');
        $id_users = $request->query->get('id_user');
        $aeroportiddepart = $request->query->get('id_aeroport1');
        $aeroportidarrivee = $request->query->get('id_aeroport2');

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
        $annonce->setDate(new \DateTime());
        $annonce->setUsers($user);
        $em->persist($annonce);
        $em->flush();
        //on cree les villes de depart et d'arrivee
        $aeroportdepart = $em->getRepository('App\Entity\Aeroportinternationnal')->find($aeroportiddepart);
        $aeroportarrivee = $em->getRepository('App\Entity\Aeroportinternationnal')->find($aeroportidarrivee);
        $villeannoncedepart = new VilleAnnonce();
        $villeannoncearrivee = new VilleAnnonce();
        $villeannoncedepart->setAeroportinternational($aeroportdepart);
        $villeannoncedepart->setAnnonce($annonce);
        $villeannoncearrivee->setAeroportinternational($aeroportarrivee);
        $villeannoncearrivee->setAnnonce($annonce);
        $em->persist($villeannoncedepart);
        $em->flush();
        $em->persist($villeannoncearrivee);
        $em->flush();


        $response = new Response(json_encode(array("succes"=>1)));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://wazzaby.com');
        return $response;
    }

}