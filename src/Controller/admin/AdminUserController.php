<?php

namespace App\Controller\admin;

use App\Entity\User;
use App\Form\AccountType;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_user_index")
     */
    public function index(UserRepository $repos, RoleRepository $roleRepos)
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $repos->findAll(),
            'admins' => $roleRepos->findBy(['title' => 'ROLE_ADMIN'])
        ]);
    }

    /**
     * Permet de modifier un utilisateur
     *
     * @Route("/admin/users/{id}/edit", name="admin_user_edit")
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash(
                'success',
                'Le profil de l\'utilisateur ' . $user->getFullName() . ' a bien été modifié'
            );

            return $this->redirectToRoute('admin_user_index');
        }


        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * Permet de supprimer un utilisateur
     *
     * @Route("admin/user/{id}/delete", name="admin_user_delete")
     *
     * @param User $user
     * @return void
     */
    public function delete(User $user, EntityManagerInterface $manager)
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur a été supprimé."
        );

        return $this->redirectToRoute('admin_user_index');
    }
}
