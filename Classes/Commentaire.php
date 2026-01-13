<?php
class Commentaire
{
    private $id;
    private $contenu;
    private $user_id;
    private $article_id;
    private $created_at;

    public function __construct($contenu, $user_id, $article_id)
    {
        $this->contenu = $contenu;
        $this->user_id = $user_id;
        $this->article_id = $article_id;
    }

    // Getters
    public function getContenu()
    {
        return $this->contenu;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getArticleId()
    {
        return $this->article_id;
    }

    public static function getAllCommentByArticle($id)
    {
        $db = DbConnection::getConnection();
        // $sql = "SELECT * from commentaires c join articles a on c.article_id = a.id where a.id = ? ORDER BY c.created_at DESC  ";
        $requet = "SELECT c.*, u.nom , u.prenom 
        FROM commentaires c 
        JOIN users u ON c.user_id = u.id 
        WHERE c.article_id = ? 
        ORDER BY c.created_at DESC";
        $stmt = $db->prepare($requet);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function cntCmntsUnderArticle($id)
    {
        $pdo = DbConnection::getConnection();
        $sql = "SELECT COUNT(*) FROM commentaires c 
        JOIN users u ON c.user_id = u.id 
        WHERE c.article_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return (int) $stmt->fetchColumn();
    }


    public function ajouterCommentaire(){
        $pdo = DbConnection::getConnection();
        $sql = "INSERT into commentaires (contenu, user_id, article_id) values (?,?,?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->contenu,$this->user_id,$this->article_id]);

    }
    
}
