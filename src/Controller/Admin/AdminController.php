<?php


namespace App\Controller\Admin;

use App\Entity\Person;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route(name="administration", methods={"GET"})
     *
     * @return Response
     */
    public function admin(): Response
    {
        $persons = $this->getDoctrine()->getRepository(Person::class)->findAll();


        return $this->render('admin/index.html.twig', array(
            'persons' => count($persons)
        ));
    }

    /**
     * @Route("/families", name="families", methods={"GET"})
     *
     * @return Response
     */
    public function families(): Response
    {
        return $this->render('admin/families.html.twig', array(
            'users' => $this->getDoctrine()->getRepository(User::class)->findAll()
        ));
    }

    /**
     * @Route("/family/{id}", name="edit_family", methods={"GET", "POST"})
     *
     * @return Response
     */
    public function editFamily(Request $request, User $user): Response
    {
        return $this->userForm($request, $user, 'profile');
    }

    /**
     * @Route("/family", name="add_family", methods={"GET", "POST"})
     *
     * @return Response
     */
    public function addFamily(Request $request): Response
    {
        $user = new User();

        return $this->userForm($request, $user, 'registration');
    }

    /**
     * @param Request $request
     * @param User $user
     * @param string $group
     * @return Response
     */
    private function userForm(Request $request, User $user, string $group): Response
    {
        $form = $this->createForm(UserType::class, $user, array(
            'validation_groups' => [$group]
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('families');
        }

        return $this->render('admin/form_family.html.twig', array(
            'form'  => $form->createView(),
            'group' => $group,
            'user'  => $user
        ));
    }
}
