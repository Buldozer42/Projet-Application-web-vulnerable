<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Inscription;
use App\Entity\Lycee;
use App\Entity\Section;
use App\Entity\Atelier;
use App\Entity\Secteur;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Créer des Secteurs
        $secteur1 = new Secteur();
        $secteur1->setNom("Secteur A");
        $secteur1->setDescription("Description du Secteur A");
        $manager->persist($secteur1);

        $secteur2 = new Secteur();
        $secteur2->setNom("Secteur B");
        $secteur2->setDescription("Description du Secteur B");
        $manager->persist($secteur2);

        // Créer des Ateliers
        $atelier1 = new Atelier();
        $atelier1->setNom("Atelier 1");
        $atelier1->setSecteur($secteur1);
        $atelier1->setIntervenant('Prof 1');
        $atelier1->setDateDebut(new \DateTime('2024-12-01 10:00:00'));
        $atelier1->setDateFin(new \DateTime('2024-12-10 12:00:00'));
        $manager->persist($atelier1);

        $atelier2 = new Atelier();
        $atelier2->setNom("Atelier 2");
        $atelier2->setSecteur($secteur2);
        $atelier2->setIntervenant('Prof 1');
        $atelier2->setDateDebut(new \DateTime('2024-12-02 14:00:00'));
        $atelier2->setDateFin(new \DateTime('2024-12-08 16:00:00'));
        $manager->persist($atelier2);

        // Créer des Lycees
        $lycee1 = new Lycee();
        $lycee1->setNom("Lycée X");
        $manager->persist($lycee1);

        $lycee2 = new Lycee();
        $lycee2->setNom("Lycée Y");
        $manager->persist($lycee2);

        // Créer des Sections
        $section1 = new Section();
        $section1->setNom("Section A");
        $manager->persist($section1);

        $section2 = new Section();
        $section2->setNom("Section B");
        $manager->persist($section2);

        // Créer un User
        $user = new User();
        $user->setEmail("user@example.com");
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'user');
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_STUDENT']);
        $user->setIsVerified(true);
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail("admin@example.com");
        $hashedPassword2 = $this->passwordHasher->hashPassword($user2, 'admin');
        $user2->setPassword($hashedPassword2);
        $user2->setRoles(['ROLE_ADMIN']);
        $user2->setIsVerified(true);
        $manager->persist($user2);

        // Créer une Inscription
        $inscription = new Inscription();
        $inscription->setNom("John");
        $inscription->setPrenom("Doe");
        $inscription->setTelephone("1234567890");
        $inscription->setLycee($lycee1);
        $inscription->setSection($section1);
        $inscription->setUser($user);
        $manager->persist($inscription);

        $inscription2 = new Inscription();
        $inscription2->setNom("Admin");
        $inscription2->setPrenom("Admin");
        $inscription2->setTelephone("1234567890");
        $inscription2->setLycee($lycee2);
        $inscription2->setSection($section2);
        $inscription2->setUser($user2);
        $manager->persist($inscription2);

        // Lier l'inscription à l'utilisateur
        $user->setInscription($inscription);
        $user2->setInscription($inscription2);

        // Sauvegarder les entités
        $manager->flush();
    }
}
