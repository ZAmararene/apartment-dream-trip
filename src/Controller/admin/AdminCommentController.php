<?php

namespace App\Controller\admin;

use App\Entity\Comment;
use App\Form\AdminCommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommentController extends AbstractController
{
    /**
     * Permet l'administrationde l'ensemble des commentaires
     *
     * @Route("/admin/comments", name="admin_comment_index")
     */
    public function index(CommentRepository $repos)
    {
        return $this->render('admin/comment/index.html.twig', [
            'comments' => $repos->findAll()
        ]);
    }

    /**
     * Permet de modifier un commentaire par l'administrateur
     *
     * @Route("/admin/comments/{id}/edit", name="admin_comment_edit")
     *
     * @param Ad $ad
     * @return Response
     */
    public function edit(Comment $comment, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AdminCommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire numéro " . $comment->getId() . " a bien été enregistré."
            );

            return $this->redirectToRoute('admin_comment_index');
        }

        return $this->render('admin/comment/edit.html.twig', [
            'form' => $form->createView(),
            'comment' => $comment
        ]);
    }

    /**
     * Permet de supprimer un commentaire
     *
     * @Route("/admin/comments/{id}/delete", name="admin_comment_delete")
     *
     * @param Comment $comment
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Comment $comment, EntityManagerInterface $manager)
    {
        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le commentaire de " . $comment->getAuthor()->getFullName() . " a bien été supprimé."
        );

        return $this->redirectToRoute('admin_comment_index');
    }
}
