<?php
namespace App\Models;
use DateTime;

class Post extends Model{
    protected $table ='posts';

    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }  
    
    public function getExcerpt(): string{
        return substr($this->content, 0, 200) . '...';
    }
/**
 * generer un bouton  avec syntaxe php Heredoc
 *
 * @return string
 */
    public function getButton(): string{
        return <<<HTML
        <a href="/afphp/posts/$this->id" class="btn btn-primary">Lire l'article</a>
HTML;
    }
    public function getTags()
    {
        return $this->query("
            SELECT t.* FROM tags t
            INNER JOIN post_tag pt ON pt.tag_id = t.id
            WHERE pt.post_id = ?
        ", [$this->id]);
    }
}