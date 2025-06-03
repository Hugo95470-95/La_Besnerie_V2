<?php

// namespace App\Controller;

// use App\Entity\Product;
// use App\Form\ProductType;
// use App\Repository\ProductRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\String\Slugger\SluggerInterface;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;


// class ProductController extends AbstractController
// {
//     #[Route('/produits', name: 'produit')]
//     public function index(ProductRepository $produitRepository): Response
//     {
//         $produits = $produitRepository->findAll();

//         return $this->render('produit/index.html.twig', [
//             'produits' => $produits,
//         ]);
//     }

//     #[Route('/produit/new', name: 'produit_new')]
//     public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
//     {
//         $produit = new Product();
//         $form = $this->createForm(ProductType::class, $produit);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $imageMainFile = $form->get('Image_main')->getData();
//             $imageSuppFile = $form->get('imageSupp')->getData();

//             if ($imageMainFile) {
//                 $originalFilename = pathinfo($imageMainFile->getClientOriginalName(), PATHINFO_FILENAME);
//                 $safeFilename = $slugger->slug($originalFilename);
//                 $newFilename = $safeFilename.'-'.uniqid().'.'.$imageMainFile->guessExtension();

//                 try {
//                     $imageMainFile->move(
//                         $this->getParameter('images_directory'),
//                         $newFilename
//                     );
//                 } catch (FileException $e) {
//                     // handle exception if something happens during file upload
//                 }

//                 $produit->setImageMain($newFilename);
//             }

//             if ($imageSuppFile) {
//                 $originalFilename = pathinfo($imageSuppFile->getClientOriginalName(), PATHINFO_FILENAME);
//                 $safeFilename = $slugger->slug($originalFilename);
//                 $newFilename = $safeFilename.'-'.uniqid().'.'.$imageSuppFile->guessExtension();

//                 try {
//                     $imageSuppFile->move(
//                         $this->getParameter('images_directory'),
//                         $newFilename
//                     );
//                 } catch (FileException $e) {
//                     // handle exception if something happens during file upload
//                 }

//                 $produit->setImageSupp($newFilename);
//             }

//             $entityManager->persist($produit);
//             $entityManager->flush();

//             return $this->redirectToRoute('produit');
//         }

//         return $this->render('produit/new.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }

//     #[Route('/produit/{id}', name: 'produit_show')]
//     public function show(Product $produit): Response
//     {
//         return $this->render('produit/show.html.twig', [
//             'produit' => $produit,
//         ]);
//     }

//     #[Route('/produit/{id}/delete', name: 'produit_delete', methods: ['POST'])]
//     public function delete(Request $request, Product $produit, EntityManagerInterface $entityManager): Response
//     {
//         if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
//             $entityManager->remove($produit);
//             $entityManager->flush();
//         }

//         return $this->redirectToRoute('produit');
//     }
// }


namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProductController extends AbstractController
{
    #[Route('/produits', name: 'produit')]
    public function index(ProductRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/new', name: 'produit_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $produit = new Product();
        $form = $this->createForm(ProductType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageMainFile = $form->get('imageMain')->getData();
            // $imageSuppFile = $form->get('imageSupp')->getData();

            if ($imageMainFile) {
                $originalFilename = pathinfo($imageMainFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageMainFile->guessExtension();

                try {
                    $imageMainFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // handle exception if something happens during file upload
                }

                $produit->setImageMain($newFilename);
            }

            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit');
        }

        return $this->render('produit/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/produit/{id}', name: 'produit_show')]
    public function show(Product $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/produit/{id}/order', name: 'order', methods: ['POST'])]
    public function addToCart(Request $request, Product $produit, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $id = $produit->getId();

        // Récupère la quantité depuis le formulaire, par défaut 1
        $quantite = (int) $request->request->get('quantite', 1);

        if (!isset($cart[$id])) {
            $cart[$id] = [
                'product' => $produit,
                'quantity' => $quantite
            ];
        } else {
            $cart[$id]['quantity'] += $quantite;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('produit_show', ['id' => $id]);
    }
}