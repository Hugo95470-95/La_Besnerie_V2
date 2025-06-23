<?php

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

// final class AccountController extends AbstractController
// {
//     #[Route('/account', name: 'app_account')]
//     public function index(): Response
//     {
//         return $this->render('account/index.html.twig', [
//             'controller_name' => 'AccountController',
//         ]);
//     }
// }





// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use Symfony\Component\HttpFoundation\Request;
// use App\Form\ChangePasswordType; // Correction : importer le bon type de formulaire
// use Doctrine\ORM\EntityManagerInterface; // Correction : utiliser l'EntityManager moderne

// class AccountController extends AbstractController
// {
//     #[Route('/account', name: 'app_account')]
//     public function index(): Response
//     {
//         return $this->render('account/index.html.twig', [
//             'controller_name' => 'AccountController',
//         ]);
//     }

//     #[Route('/account/password', name: 'app_account_password')]
//     public function changePassword(
//         Request $request,
//         UserPasswordHasherInterface $passwordHasher,
//         EntityManagerInterface $entityManager // Injection de l'EntityManager
//     ): Response {
//         $user = $this->getUser();
//         $form = $this->createForm(ChangePasswordType::class);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $currentPassword = $form->get('current_password')->getData();
//             $newPassword = $form->get('new_password')->getData();

//             if (
//                 !$user ||
//                 !$user instanceof \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface ||
//                 !$passwordHasher->isPasswordValid($user, $currentPassword)
//             ) {
//                 $this->addFlash('error', 'Mot de passe actuel incorrect.');
//             } else {
//                 $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
//                 $entityManager->flush(); // Utilisation de l'EntityManager injecté
//                 $this->addFlash('success', 'Mot de passe modifié avec succès.');
//                 return $this->redirectToRoute('app_account');
//             }
//         }

//         return $this->render('account/change_password.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }
// }



namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Utilisateur;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/account/password', name: 'app_account_password')]
    public function changePassword(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $form->get('current_password')->getData();
            $newPassword = $form->get('new_password')->getData();

            if (
                !$user ||
                !$user instanceof \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface ||
                !$passwordHasher->isPasswordValid($user, $currentPassword)
            ) {
                $this->addFlash('erreur', 'Mot de passe actuel incorrect.');
            } else {
                $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
                $entityManager->flush();
                $this->addFlash('succès', 'Mot de passe modifié avec succès.');
                return $this->redirectToRoute('accueil');
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function resetPassword(
        string $token,
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        // Rechercher l'utilisateur par son token
        $user = $entityManager->getRepository(Utilisateur::class)->findOneBy(['token' => $token]);
        if (!$user) {
            throw $this->createNotFoundException('Token invalide.');
        }

        // Formulaire pour saisir le nouveau mot de passe avec contraintes
        $form = $this->createFormBuilder()
            ->add('plainPassword', PasswordType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez entrer un mot de passe.']),
                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'Minimum de 6 caractères pour le mot de passe, et maximum de 100 caractères.',
                        'max' => 100,
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^(?=.*[A-Z])(?=.*\d).+$/',
                        'message' => 'Votre mot de passe doit contenir au moins 1 majuscule et 1 chiffre.',
                    ]),
                ],
                'label' => 'Nouveau mot de passe'
            ])
            ->add('confirmPassword', PasswordType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez confirmer votre mot de passe.']),
                ],
                'label' => 'Confirmation'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Vérifier que les deux mots de passe correspondent
            if ($data['plainPassword'] !== $data['confirmPassword']) {
                $this->addFlash('danger', 'Les mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_reset_password', ['token' => $token]);
            }

            // Hasher le nouveau mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $data['plainPassword']);
            $user->setMotdepasse($hashedPassword);

            // Effacer le token après utilisation
            $user->setToken(null);
            $entityManager->flush();

            $this->addFlash('succès', 'Votre mot de passe a été modifié avec succès.');
            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('security/reset-password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}