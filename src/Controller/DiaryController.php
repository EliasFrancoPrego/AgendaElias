<?php

namespace App\Controller;

use App\Entity\Diary;
use App\Form\CreateDiaryFormType;
use App\Repository\DiaryRespository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class DiaryController extends AbstractController
{
    /**
     * @Route("/diary", name="diary", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $contactos = null;
        $Tipocontacto = $request->query->get('contact_type');
        
        /** @var DiaryRespository $repository */
        $repository = $this->getDoctrine()->getRepository(Diary::class);

        if(!is_null($Tipocontacto)) {
            $contactos = $repository->findByTipocontacto($Tipocontacto);
        } else {
            $contactos = $repository->findAll();
        }
        
        return $this->render('index.html.twig', [
            'contacts' => $contactos,
        ]);
    }

    /**
     * @Route("/diary/create", name="diary.create", methods={"GET", "POST"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $diary = new Diary();
        
        $form = $this->createForm(CreateDiaryFormType::class, $diary, [
            'action' => $this->generateUrl('diary.create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $diary = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($diary);
            $em->flush();

            $this->addFlash('success', 'Contacto agregado satisfactoriamente');

            return $this->redirectToRoute('diary', ['contact_type' => $diary->getTipocontacto()]);
        }
        
        return $this->render('create.html.twig', [
            'diaryForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/diary/{id}", name="diary.show")
     * @param Diary $diary
     * @return Response
     */
    public function show(Diary $diary): Response
    {
        return $this->render('show.html.twig', [
            'contact' => $diary
        ]);
    }

    /**
     * @Route("/diary/{id}/edit", name="diary.edit", methods={"GET", "PUT"})
     * @param Request $request
     * @param Diary $diary
     * @return Response
     */
    public function edit(Request $request, Diary $diary): Response
    {
        $form = $this->createForm(CreateDiaryFormType::class, $diary, [
            'action' => $this->generateUrl('diary.edit', ['id' => $diary->getId()]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $diary = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($diary);
            $em->flush();

            $this->addFlash('success', 'Contacto actualizado satisfactoriamente');

            return $this->redirectToRoute('diary', ['contact_type' => $diary->getTipocontacto()]);
        }

        return $this->render('create.html.twig', [
            'diaryForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/diary/{id}/delete", name="diary.delete")
     * @param Diary $diary
     * @return Response
     */
    public function delete(Diary $diary): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($diary);
        $em->flush();

        return $this->redirectToRoute('diary', ['contact_type' => $diary->getTipocontacto()]);
    }
}
