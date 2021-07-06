<?php 

namespace App\Controller\Admin\Category;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateCategoryController extends AbstractController
{
    /**
     * @Route("admin/category/create", name="create_category")
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Category $category */
            $category = $form->getData();
            
            //Je récupère l'image
            $image = $form->get('imageUrl')->getData();

            //Je vérifie que l'image existe bel et bien.
            if($image !== null)
            {
                $file = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('app_images_directory'),
                    $file
                );

                $category->setImageUrl('/uploads/'. $file);
            }

            $em->persist($category);

            $em->flush();

            $this->addFlash('success','Votre catégorie ' . $category->getName() . ' a bien été créé.');
            return $this->redirectToRoute('list_category');
        }

        return $this->render('admin/category/create_category.html.twig',[
            'formCategory' => $form->createView()
        ]);
    }
}