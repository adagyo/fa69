<?php

namespace Adagyo\FA69Bundle\Controller;

use Adagyo\FA69Bundle\Entity\bill;
use Adagyo\FA69Bundle\Entity\line;
use Adagyo\FA69Bundle\Entity\vat;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Adagyo\FA69Bundle\Entity\customer;
use Adagyo\FA69Bundle\Entity\car;


class AjaxController extends Controller {

    const ML = 7;
    const MT = 57;
    const MR = 7;
    const MB = 35;

    public function getCustomerAction() {
        $request = $this->getRequest();
        $field = $request->get('field');
        $search = $request->get('search');
        $serializer = $this->get('jms_serializer');

        $repo = $this->getDoctrine()->getRepository('AdagyoFA69Bundle:customer');

        $results = $repo->findCustomer($field,$search);

        return new Response($serializer->serialize(array("customers" => $results), 'json'), 200, array('Content-type' => 'application/json'));
    }

    public function getRegPlateAction() {
        $request = $this->getRequest();
        $search = $request->get('search');
        $serializer = $this->get('jms_serializer');

        $repo = $this->getDoctrine()->getRepository('AdagyoFA69Bundle:car');

        $results = $repo->findRegPlate($search);

        return new Response($serializer->serialize(array("cars" => $results), 'json'), 200, array('Content-type' => 'application/json'));
    }

    public function saveCustomerAction() {
        $request = $this->getRequest();
        $cust = new customer();
        $serializer = $this->get('jms_serializer');

        $cust->setCivility($request->get('civility'));
        $cust->setLastname($request->get('lastname'));
        $cust->setFirstname($request->get('firstname'));
        $cust->setAddress($request->get('address'));
        $cust->setPostalcode($request->get('postalcode'));
        $cust->setCity($request->get('city'));
        $cust->setPhone($request->get('phone'));
        $cust->setMobile($request->get('mobile'));

        $validator = $this->get('validator');
        $errors = $validator->validate($cust);
        if(count($errors) > 0) {
            $arrErrors = array();
            foreach($errors as $error) { array_push($arrErrors,$error); }
            return new Response($serializer->serialize(array('errors' => $arrErrors), 'json'), 400, array('Content-type' => 'application/json'));
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cust);
            $em->flush();
            return new Response($serializer->serialize($cust, 'json'), 201, array('Content-type' => 'application/json'));
        }
    }

    public function editCustomerAction() {
        $request = $this->getRequest();
        $repository = $this->getDoctrine()->getManager()->getRepository('AdagyoFA69Bundle:customer');
        $cust = $repository->find($request->get('id'));
        $serializer = $this->get('jms_serializer');

        if($cust === null) {
            $arrErrors = array();
            array_push($arrErrors,array('message' => 'Une erreur s\'est produite: Client inexistant!'));
            return new Response($serializer->serialize(array('errors' => $arrErrors), 'json'), 400, array('Content-type' => 'application/json'));
        } else {
            $cust->setCivility($request->get('civility'));
            $cust->setLastname($request->get('lastname'));
            $cust->setFirstname($request->get('firstname'));
            $cust->setAddress($request->get('address'));
            $cust->setPostalcode($request->get('postalcode'));
            $cust->setCity($request->get('city'));
            $cust->setPhone($request->get('phone'));
            $cust->setMobile($request->get('mobile'));

            $validator = $this->get('validator');
            $errors = $validator->validate($cust);
            if(count($errors) > 0) {
                $arrErrors = array();
                foreach($errors as $error) { array_push($arrErrors,$error); }
                return new Response($serializer->serialize(array('errors' => $arrErrors), 'json'), 400, array('Content-type' => 'application/json'));
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cust);
                $em->flush();
                return new Response($serializer->serialize($cust, 'json'), 200, array('Content-type' => 'application/json'));
            }
        }
    }

    public function getCarAction() {
        $request = $this->getRequest();
        $customerId = $request->get('customerId');
        $search = $request->get('search');
        $serializer = $this->get('jms_serializer');

        $repo = $this->getDoctrine()->getManager()->getRepository('AdagyoFA69Bundle:car');

        $results = $repo->findAllCarsOfCustomer($customerId,$search);

        return new Response($serializer->serialize(array("cars" => $results), 'json'), 200, array('Content-type' => 'application/json'));
    }

    public function saveCarAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $cust = $em->getRepository('AdagyoFA69Bundle:customer')->find($request->get('customerId'));
        $serializer = $this->get('jms_serializer');

        $car = new car();
        $car->setCustomer($cust);
        $car->setRegPlate($request->get('regPlate'));
        $car->setBrand($request->get('brand'));
        $car->setYear($request->get('year'));
        $car->setMileage($request->get('mileage'));

        $validator = $this->get('validator');
        $errors = $validator->validate($car);
        if(count($errors) > 0) {
            $arrErrors = array();
            foreach($errors as $error) { array_push($arrErrors,$error); }
            return new Response($serializer->serialize(array('errors' => $arrErrors), 'json'), 400, array('Content-type' => 'application/json'));
        } else {
            $em->persist($car);
            $em->flush();
            return new Response($serializer->serialize($car, 'json'), 201, array('Content-type' => 'application/json'));
        }
    }

    public function editCarAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdagyoFA69Bundle:car');
        $car = $repository->find($request->get('id'));
        $serializer = $this->get('jms_serializer');
        if($car === null) {
            $arrErrors = array();
            array_push($arrErrors,array('message' => 'Une erreur s\'est produite: Véhicule inexistant!'));
            return new Response($serializer->serialize(array('errors' => $arrErrors), 'json'), 400, array('Content-type' => 'application/json'));
        } else {
            $car->setRegPlate($request->get('regPlate'));
            $car->setBrand($request->get('brand'));
            $car->setYear($request->get('year'));
            $car->setMileage($request->get('mileage'));

            $validator = $this->get('validator');
            $errors = $validator->validate($car);
            if(count($errors) > 0) {
                $arrErrors = array();
                foreach($errors as $error) { array_push($arrErrors,$error); }
                return new Response($serializer->serialize(array('errors' => $arrErrors), 'json'), 400, array('Content-type' => 'application/json'));
            } else {
                $em->persist($car);
                $em->flush();
                return new Response($serializer->serialize($car, 'json'), 201, array('Content-type' => 'application/json'));
            }
        }
    }

    public function getProductAction() {
        $request = $this->getRequest();
        $search = $request->get('search');
        $serializer = $this->get('jms_serializer');

        $repo = $this->getDoctrine()->getManager()->getRepository('AdagyoFA69Bundle:line');

        $results = $repo->findAllByLineLabel($search);

        return new Response($serializer->serialize(array("lines" => $results), 'json'), 200, array('Content-type' => 'application/json'));
    }

    public function previewBillAction() {
        // TODO: Validation des formulaire
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $kernel = $this->get('kernel');

        $rootDir = $kernel->getRootDir() . '/..';
        $file = 'Facture_' . time() . '.pdf';
        $tmp = $rootDir . '/web/tmp/' . $file;

        $repository = $em->getRepository('AdagyoFA69Bundle:customer');
        $customer = $repository->find($request->get('customerId'));
        $repository = $em->getRepository('AdagyoFA69Bundle:car');
        $car = $repository->find($request->get('carId'));

        $html2pdf = new Html2Pdf('P','A4','fr',true,'UTF-8',array(self::ML,self::MT,self::MR,self::MB));
        $html = $this->renderView('AdagyoFA69Bundle:Bill:bill.html.twig', array(
            'billId'    => '----------',
            'customer'  => $customer,
            'car'       => $car,
            'date'      => $request->get('date'),
            'lines'     => $request->get('lines'),
            'totalExVATNewPart' => $request->get('totalExVATNewPart'),
            'totalVATNewPart'   => $request->get('totalVATNewPart'),
            'totalExVATOldPart' => $request->get('totalExVATOldPart'),
            'totalDiscount'     => $request->get('totalDiscount'),
            'VAT'               => $request->get('VAT'),
            'vatRate'           => $request->get('vatRate'),
            'totalAmount'       => $request->get('totalAmount'),
            'paymentMethod'     => $request->get('paymentMethod'),
            'settlementDate'    => $request->get('settlementDate'),
            'preview'           => true,
        ));

        $html2pdf->writeHTML($html);
        $html2pdf->Output($tmp, 'F');

        return new Response($request->getBasePath().'/tmp/'.$file, 200);
    }

    public function saveBillAction() {
        // TODO: Validation des formulaire
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');
        $reponse = array();

        /* Sauvegarde de la facture */
        $tmp = explode('/',$request->get('date')); $date = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];


        if($request->get('billId') == '') {
            $bill = new bill();
        } else {
            $repository = $em->getRepository('AdagyoFA69Bundle:bill');
            $bill = $repository->find($request->get('billId'));
        }
        $bill->setDate(new \DateTime($date));
        $bill->setSettlementDate($request->get('settlementDate'));
        $bill->setPaymentMethod($request->get('paymentMethod'));
        $bill->setTotalExVATNewPart($request->get('totalExVATNewPart'));
        $bill->setTotalVATNewPart($request->get('totalVATNewPart'));
        $bill->setTotalExVATOldPart($request->get('totalExVATOldPart'));
        $bill->setTotalDiscount($request->get('totalDiscount'));
        $bill->setVAT($request->get('VAT'));
        $bill->setTotalAmount($request->get('totalAmount'));

        $repository = $em->getRepository('AdagyoFA69Bundle:vat');
        $vatRate = $repository->find($request->get('vatRateId'));
        $bill->setVatRate($vatRate);

        $repository = $em->getRepository('AdagyoFA69Bundle:customer');
        $customer = $repository->find($request->get('customerId'));
        $bill->setCustomer($customer);

        $repository = $em->getRepository('AdagyoFA69Bundle:car');
        $car = $repository->find($request->get('carId'));
        $bill->setCar($car);
        $bill->setCarMileage($car->getMileage());

        foreach($request->get('lines') as $i => $line) {
            if($line['lineLabel'] != '') {
                $l = new line();
                $l->setNumber($i+1);
                $l->setLineLabel($line['lineLabel']);
                $l->setQuality($line['quality']);
                $l->setQuantity($line['quantity']);
                $l->setDiscount($line['discount']);
                $l->setUnitPriceVAT($line['unitPriceVAT']);
                $bill->addLine($l);
                $em->persist($l);
            }
        }

        $em->persist($bill);

        /* Persistance en BDD */
        $em->flush();
        $reponse['billId'] = $bill->getId();

        /* Impression en pdf */
        $kernel = $this->get('kernel');

        $rootDir = $kernel->getRootDir() . '/..';
        $file = 'Facture_' . $bill->getId() . '.pdf';
        $tmp = $rootDir . '/web/bills/' . $file;

        $html2pdf = new Html2Pdf('P','A4','fr',true,'UTF-8',array(self::ML,self::MT,self::MR,self::MB));
        $html = $this->renderView('AdagyoFA69Bundle:Bill:bill.html.twig', array(
            'billId'    => $bill->getId(),
            'customer'  => $customer,
            'car'       => $car,
            'date'      => $request->get('date'),
            'lines'     => $request->get('lines'),
            'totalExVATNewPart' => $request->get('totalExVATNewPart'),
            'totalVATNewPart'   => $request->get('totalVATNewPart'),
            'totalExVATOldPart' => $request->get('totalExVATOldPart'),
            'totalDiscount'     => $request->get('totalDiscount'),
            'VAT'               => $request->get('VAT'),
            'vatRate'           => $bill->getVatRate()->getRate(),
            'totalAmount'       => $request->get('totalAmount'),
            'paymentMethod'     => $request->get('paymentMethod'),
            'settlementDate'    => $request->get('settlementDate'),
            'preview'           => false,
        ));

        $html2pdf->writeHTML($html);
        $html2pdf->Output($tmp, 'F');

        $reponse['billPdf'] = $request->getBasePath().'/bills/'.$file;
        return new Response($serializer->serialize($reponse, 'json'), 201, array('Content-type' => 'application/json'));
    }

    public function searchBillAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');

        $billId = $request->get('billId');
        $customerId = $request->get('customerId');
        $carId = $request->get('carId');
        $dateFrom = $request->get('dateFrom');
        $dateTo = $request->get('dateTo');
        $limit =  $request->get('limit');
        $offset =  $request->get('offset');

        $results = null;
        $repository = $em->getRepository('AdagyoFA69Bundle:bill');

        if($billId) {
            $results = array($repository->find($billId));
        } elseif($customerId) {
            $results = $repository->getBillsByCustomerId($customerId,$dateFrom,$dateTo,$limit,$offset);
        } elseif($carId) {
            $results = $repository->getBillsByCarId($carId,$dateFrom,$dateTo,$limit,$offset);
        } elseif($dateFrom || $dateTo) {
            $results = $repository->getBillsByDates($dateFrom,$dateTo,$limit,$offset);
        } else {
            return new Response('Veuillez replir au moins un champ du formulaire de recherche SVP!',400);
        }

        return new Response($serializer->serialize(array("results" => $results), 'json'), 200, array('Content-type' => 'application/json'));
    }

    public function searchCustomerAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');

        $customerId = $request->get('customerId');
        $customerName = $request->get('customerName');
        $limit =  $request->get('limit');
        $offset =  $request->get('offset');

        $results = null;
        $repository = $em->getRepository('AdagyoFA69Bundle:customer');
        if($customerId) {
            $results = array($repository->find($customerId));
        } elseif($customerName) {
            $customerName = str_replace('*','%',$customerName);
            $results = $repository->findCustomerByName($customerName,$offset,$limit);
        }else {
            return new Response('Veuillez replir au moins un champ du formulaire de recherche SVP!',400);
        }

        return new Response($serializer->serialize(array("results" => $results), 'json'), 200, array('Content-type' => 'application/json'));
    }

    public function getBillAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');

        $repository = $em->getRepository('AdagyoFA69Bundle:bill');
        $bill = $repository->find($request->get('id'));

        /* Impression en pdf */
        $kernel = $this->get('kernel');

        $rootDir = $kernel->getRootDir() . '/..';
        $file = 'Facture_' . $bill->getId() . '.pdf';
        $tmp = $rootDir . '/web/bills/' . $file;

        $billLines = $bill->getLines();
        $linesArr = array();
        for($i = 0; $i < 17; $i++) {
            $l = new line();
            $l->setQuantity(0);
            $l->setNumber($i+1);
            $linesArr[$i] = $l;
        }
        for($i = 0; $i < count($billLines); $i++) {
            $l = $billLines[$i];
            $idx = $l->getNumber();
            $linesArr[$idx] = $l;
        }

        $html2pdf = new Html2Pdf('P','A4','fr',true,'UTF-8',array(self::ML,self::MT,self::MR,self::MB));
        $html = $this->renderView('AdagyoFA69Bundle:Bill:bill.html.twig', array(
            'billId'    => $bill->getId(),
            'customer'  => $bill->getCustomer(),
            'car'       => $bill->getCar(),
            'date'      => $bill->getDate()->format('d/m/Y'),
            'lines'     => $linesArr,
            'totalExVATNewPart' => $bill->getTotalVATNewPart(),
            'totalVATNewPart'   => $bill->getTotalVATNewPart(),
            'totalExVATOldPart' => $bill->getTotalExVATOldPart(),
            'totalDiscount'     => $bill->getTotalDiscount(),
            'VAT'               => $bill->getVAT(),
            'vatRate'           => $bill->getVatRate()->getRate(),
            'totalAmount'       => $bill->getTotalAmount(),
            'paymentMethod'     => $bill->getPaymentMethod(),
            'settlementDate'    => $bill->getSettlementDate(),
            'preview'           => false,
        ));

        $html2pdf->writeHTML($html);
        $html2pdf->Output($tmp, 'F');

        $response['billPdf'] = $request->getBasePath().'/bills/'.$file;
        return new Response($serializer->serialize($response, 'json'), 201, array('Content-type' => 'application/json'));
    }

    public function saveVatAction() {
        $request = $this->getRequest();
        $vatRate = $request->get('vatRate');
        $serializer = $this->get('jms_serializer');

        $newVat = new vat();
        $newVat->setRate($vatRate);
        $newVat->setIsCurrent(true);
        $validator = $this->get('validator');
        $errors = $validator->validate($newVat);

        if(count($errors) > 0) {
            $arrErrors = array();
            foreach($errors as $error) { array_push($arrErrors,$error); }
            return new Response($serializer->serialize(array('errors' => $arrErrors), 'json'), 400, array('Content-type' => 'application/json'));
        } else {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AdagyoFA69Bundle:vat');
            // Désactivation de toute les VAT
            $vats = $repository->findAll();
            foreach($vats as $vat) {
                $vat->setIsCurrent(false);
                $em->persist($vat);
            }
            // Recherche si le taux est déjà en base
            $vatExists = $repository->findOneByRate($vatRate);
            if($vatExists) {
                $vatExists->setIsCurrent(true);
                $em->persist($vatExists);
            } else {
                $em->persist($newVat);
            }
            $em->flush();
        }

        return new Response($serializer->serialize(array("rate" => $vatRate), 'json'), 200, array('Content-type' => 'application/json'));
    }

    public function statsCaAction() {
        $serializer = $this->get('jms_serializer');
        $db = $this->get('database_connection');
        $tmpneuf = $tmpoccasion = $tmpremise = array();
        $neuf = $occasion = $remise = array();

        /* CA Neuf et Occasion */
        $query  = "SELECT l.bill_id, unix_timestamp(convert_tz(b.date,'+00:00','+02:00'))*1000 AS D, SUM(l.quantity*l.unitPriceVAT*(1-l.discount/100)) AS S ";
        $query .= "FROM line l, bill b WHERE l.quality = ? AND l.bill_id = b.id ";
        $query .= "GROUP BY l.bill_id HAVING S >= 0 ORDER BY b.date ASC";

        $results = $db->executeQuery($query, array('Neuf'))->fetchAll();
        foreach ($results as $r) {
            $key = strval($r['D']);
            if(!array_key_exists($key,$tmpneuf)) { $tmpneuf[$key] = 0; }
            $tmpneuf[$key] += round(floatval($r['S']),2);
        }
        foreach ($tmpneuf as $k => $v){ array_push($neuf, array(doubleval($k), $v)); }

        $results = $db->executeQuery($query, array('Occasion'))->fetchAll();
        foreach ($results as $r) {
            $key = strval($r['D']);
            if(!array_key_exists($key,$tmpoccasion)) { $tmpoccasion[$key] = 0; }
            $tmpoccasion[$key] += round(floatval($r['S']),2);
        }
        foreach ($tmpoccasion as $k => $v){ array_push($occasion, array(doubleval($k), $v)); }

        /* Remise */
        $query  = "SELECT l.bill_id, unix_timestamp(convert_tz(b.date,'+00:00','+02:00'))*1000 AS D, SUM(l.quantity*l.unitPriceVAT*(l.discount/100)) AS S ";
        $query .= "FROM line l, bill b WHERE l.bill_id = b.id GROUP BY l.bill_id ORDER BY b.date ASC";
        $results = $db->executeQuery($query)->fetchAll();
        foreach ($results as $r) {
            $key = strval($r['D']);
            if(!array_key_exists($key,$tmpremise)) { $tmpremise[$key] = 0; }
            $tmpremise[$key] += round(floatval($r['S']),2);
        }
        foreach ($tmpremise as $k => $v){ array_push($remise, array(doubleval($k), $v)); }

        $results = array("neuf" => $neuf, "occasion" => $occasion, "remise" => $remise);

        return new Response($serializer->serialize($results, 'json'), 200, array('Content-type' => 'application/json'));
    }
}