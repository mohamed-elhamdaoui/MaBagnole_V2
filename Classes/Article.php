<?php

class Article
{
    private $id;
    private $titre;
    private $contenu;
    private $image_url;
    private $video_url;
    private $theme_id;
    private $auteur_id;
    private $statut;
    private $created_at;

    public function __construct(
        $titre,
        $contenu,
        $auteur_id,
        $image_url,
        $video_url,
        $theme_id,
        $statut = 'en_attente',
        $id = null,
        $created_at = ""
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->image_url = $image_url;
        $this->video_url = $video_url;
        $this->theme_id = $theme_id;
        $this->auteur_id = $auteur_id;
        $this->statut = $statut;
        $this->created_at = $created_at;
    }

    // --- GETTERS ---

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getImageUrl()
    {
        return $this->image_url;
    }

    public function getVideoUrl()
    {
        return $this->video_url;
    }

    public function getThemeId()
    {
        return $this->theme_id;
    }

    public function getAuteurId()
    {
        return $this->auteur_id;
    }

    public function getStatut()
    {
        return $this->statut;
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

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    public function setVideoUrl($video_url)
    {
        $this->video_url = $video_url;
    }

    public function setThemeId($theme_id)
    {
        $this->theme_id = $theme_id;
    }

    public function setAuteurId($auteur_id)
    {
        $this->auteur_id = $auteur_id;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }


    public static function getAllArtcile()
    {
        $pdo = DbConnection::getConnection();

        $sql = "SELECT * from articles WHERE statut in ('approuve') ORDER BY created_at";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = new Article($row["titre"], $row["contenu"], $row["auteur_id"], $row["image_url"], video_url: $row["video_url"], theme_id: $row["theme_id"], statut: $row["statut"], id: $row["id"]);
        }
        return $arr;
    }


    public function ajouterArticle(array $tags)
    {
        try {
            $pdo = DbConnection::getConnection();
            $pdo->beginTransaction();

            $sql = "INSERT into articles (titre,contenu,image_url,video_url,theme_id,auteur_id) VALUES (?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->titre, $this->contenu, $this->image_url, $this->video_url, $this->theme_id, $this->auteur_id]);

            $articleId = $pdo->lastInsertId();

            foreach ($tags as $tagname) {
                $tagname = trim($tagname);
                if (empty($tagname)) continue;  // éviter les tagss viddde
                $stmttag = $pdo->prepare("INSERT IGNORE into tags (nom) values (:nom) ");
                $stmttag->execute([':nom' => $tagname]);

                $stmtGetTag = $pdo->prepare("SELECT id from tags where nom = :nom");
                $stmtGetTag->execute([':nom' => $tagname]);
                $tagId = $stmtGetTag->fetchColumn();

                $stmtLink = $pdo->prepare("INSERT into article_tags (article_id,tag_id) values (:a_id , :t_id)");
                $stmtLink->execute([':a_id' => $articleId, ':t_id' => $tagId]);
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getArticleByTheme($id_theme)
    {
        $db = DbConnection::getConnection();
        $sql = "SELECT a.* , t.nom from articles a join themes t on a.theme_id = t.id where t.id = ? ";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_theme]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByTitle($keyword)
    {
        try {
            $pdo = DbConnection::getConnection();


            $searchTerm = "%" . $keyword . "%";

            $sql = "SELECT a.*, t.nom as theme_nom, u.nom as auteur_nom 
                FROM articles a
                JOIN themes t ON a.theme_id = t.id
                JOIN users u ON a.auteur_id = u.id
                WHERE a.titre LIKE :search 
                AND a.statut = 'approuve'
                ORDER BY a.created_at DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':search' => $searchTerm]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de recherche : " . $e->getMessage());
        }
    }

    public static function getArticleTheme($id)
    {
        $sql = "SELECT DISTINCT t.nom from themes t join articles a on a.theme_id = t.id where a.theme_id = ?";
        $db = DbConnection::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["nom"];
    }


    public static function getArticleByid($id)
    {
        $sql = "SELECT * from articles a join themes t on a.theme_id = t.id where a.id = ?";
        $db = DbConnection::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public static function getLatestArticle()
    {

        $pdo = DbConnection::getConnection();
        $sql = "SELECT * from articles WHERE statut = 'approuve' order by created_at LIMIT 3";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getTagsByArticle($id)
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT t.nom
            FROM tags t
            JOIN article_tags at ON t.id = at.tag_id
            WHERE at.article_id = ?;
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getArticleBySingleUser($id)
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT a.* , t.nom from articles a join themes t on a.theme_id = t.id WHERE a.auteur_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getAllArticlesAllStates()
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT
                    a.*,
                    t.nom,
                    u.nom as auteur_nom,
                    u.prenom as auteur_prenom
                from
                    articles a
                    join themes t on a.theme_id = t.id
                    join users u ON a.auteur_id = u.id
                ORDER BY a.created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function approuveArticle($id)
    {
        $pdo = DbConnection::getConnection();
        $sql = "UPDATE articles set statut = 'approuve'where id= ?  ";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function rejeteArticle($id)
    {
        $pdo = DbConnection::getConnection();
        $sql = "UPDATE articles set statut = 'rejete' where id= ?  ";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public static function countEnAttend()
    {
        $pdo = DbConnection::getConnection();
        $stmt = $pdo->query("SELECT count(*) from articles where statut = 'en_attente'");
        return $stmt->fetchColumn();
    }
    public static function countEnPublie()
    {
        $pdo = DbConnection::getConnection();
        $stmt = $pdo->query("SELECT count(*) from articles where statut = 'approuve'");
        return $stmt->fetchColumn();
    }
}
