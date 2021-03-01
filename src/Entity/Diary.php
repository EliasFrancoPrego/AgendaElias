<?php

namespace App\Entity;

use App\Repository\DiaryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=DiaryRepository::class)
 * @UniqueEntity("email", message="El correo electronico ya se encuentra registrado")
 */
class Diary 
{
    /**
     * @var string
     * Person contact enum
     */
    public const CONTACTO_PERSONAL = 'personal';

    /**
     * @var string
     * Profesional contact enum
     */
    public const CONTACTO_PROFESIONAL = 'profesional';

    /**
     * @var array
     * Allowed contact types
     */
    public const ALLOWED_CONTACT_TYPE = [
        self::CONTACTO_PERSONAL,
        self::CONTACTO_PROFESIONAL
    ];
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @var string $Tipocontacto
     * @ORM\Column(type="string", name="Tipocontacto")
     */
    private string $Tipocontacto;

    /**
     * @var string $name
     * @ORM\Column(type="string", name="name")
     */
    private string $name;

    /**
     * @var string $lastName
     * @ORM\Column(type="string", name="last_name")
     */
    private string $lastName;

    /**
     * @var string $phone
     * @ORM\Column(type="string", name="phone")
     */
    private string $phone;

    /**
     * @var string $email
     * @ORM\Column(type="string", name="email", unique=true)
     */
    private string $email;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTipocontacto(): string
    {
        return $this->Tipocontacto;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $Tipocontacto
     */
    public function setTipocontacto(string $Tipocontacto): void
    {
        $this->Tipocontacto = $Tipocontacto;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
