<?php

class Theme
{
    private  $id;
    private  $nom;
    private  $description;
    private  $created_at;

    public function __construct(
        $nom = "",
        $description = null,
        $id = null,
        $created_at = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->created_at = $created_at;
    }

    // --- GETTERS ---

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    // --- SETTERS ---

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public static function getAllTheme(){
        $pdo = DbConnection::getConnection();
        
        $stmt = $pdo->query("SELECT t.nom ,  COUNT(*) as nmbr_aricle from themes t JOIN articles a on t.id = a.theme_id GROUP BY t.id");
        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $themes;
    }

    
}
