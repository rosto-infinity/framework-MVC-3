<?php
namespace App\controllers;


use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller{
   
   
        public function welcome (){
        return $this->view('blog.welcome');

    }
   
    public function index(){
        $post = new Post($this->getDB());
        $posts = $post->all();

        return $this->view('blog.index', compact('posts'));
    }

    public function show(int $id){
        $post = new Post($this->getDB());
        $post = $post->findById($id);

        return $this->view('blog.show', compact('post'));
    }

    
    public function tag(int $id){
        // $tag = new Tag($this->getDB());
        // $tag->findById($id);

        $tag = (new Tag($this->getDB()))->findById($id);
 
        return $this->view('blog.tag', compact('tag'));
    }

}





    //     public function welcome (){
    //     return $this->view('blog.welcome');

    // }
   
    // public function index(){
    //     // $stmt = $this->db->getPDO()->query("SELECT * FROM posts ORDER BY created_at DESC");
    //     // $posts = $stmt->fetchAll();
        
    //     // return $this->view('blog.index', compact('posts'));
       
    // }

    // public function show(int $id){

    //     $stmt = $this->db->getPDO()->prepare("SELECT * FROM posts WHERE id = ? ");
        
    //     $stmt->execute([$id]);
        
    //     $post = $stmt->fetch();
        
    //     return $this->view('blog.show', compact('post'));
    // }
