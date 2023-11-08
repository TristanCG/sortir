<?php

namespace App\Controller;

    use App\Form\ProfilType;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\File\Exception\FileException;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\String\Slugger\SluggerInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProfilType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            // Gérer le téléchargement de l'image s'il y en a une
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception s'il se passe quelque chose pendant le téléchargement du fichier
                }

                // Mettre à jour le nom du fichier de l'image dans la base de données
                $this->getUser()->setFilename($newFilename);
            }



            // Gérer la mise à jour de l'utilisateur
            $em->persist($this->getUser());
            $em->flush();

            // Rediriger l'utilisateur vers une page de confirmation ou vers une autre page
            return $this->redirectToRoute('_profiler_home'); // Assurez-vous de remplacer '_profiler_home' par la route appropriée.
        }

        return $this->render('profil/profil.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
