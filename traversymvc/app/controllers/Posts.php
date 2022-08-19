<?php
class Posts extends Controller
{

    public function __construct()
    {
        //Posts Access Control i can not to Access the posts seite direct i have to login the first 
        if (!isLoggedIn()) {
            #if not loggedin it must to rturn me to login seite
            #the method isLoggedIn  is in helper file 
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        $posts = $this->postModel->getPosts();
        //create a empty erray
        $data = [
            'posts' => $posts
        ];
        # load view method ...
        $this->view('posts/index', $data);
    }
    public function Add()
    {
        // when i click off button add i must to send form i use super Globel Variable
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            #Sanitize Post array 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data = ['title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => ''
            ];

            // i mut to creat a Validation for input title when empty that i get a error message down the input 
            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter the Tilte';
            }
            if (empty($data['body'])) {
                $data['body_error'] = 'Please enter the Body';
            }
            if (empty($data['title_error']) && empty($data['body_error'])) {
            
                //Valdieted 
                if($this->postModel->addPost($data)){
                    flash('post_added','Post Added');
                    redirect('posts');
                }else {
                    die('Something went wrong');
                }
            }
            else {
                //load View Withe Error
                $this->view('posts/add',$data);
            }
        }
        else {
            # this method for add post in post model to add new record in databsse 
            # creat a array to put title and body for thie blog 

            $data = ['title' => '',
                'body' => ''];
            $this->view('posts/add', $data);
        }

    }
    // this Method to show me when i click off more withe id from record i get all the content about it 
    public function show($id)
    {
        $post = $this->postModel->getPostsById($id);
        $user = $this->userModel->getUserById($post->users_id);

        $data =  [ 'post' => $post,
                    'user' => $user];

        $this->view('posts/show', $data);
    }
    public function Edit($id)
    {
        // when i click off button add i must to send form i use super Globel Variable
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            #Sanitize Post array 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data = ['title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => '',
                'id' => $id
            ];

            // i mut to creat a Validation for input title when empty that i get a error message down the input 
            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter the Tilte';
            }
            if (empty($data['body'])) {
                $data['body_error'] = 'Please enter the Body';
            }
            if (empty($data['title_error']) && empty($data['body_error'])) {
            
                //Valdieted 
                if($this->postModel->updatePost($data)){
                    flash('post_update','Post updated');
                    redirect('posts');
                }else {
                    die('Something went wrong');
                }
            }
            else {
                //load View Withe Error
                $this->view('posts/edit',$data);
            }
        }
        else {
            //get existing post from model
            $post = $this->postModel->getPostsById($id);
            //check for Owner
            if ($post->users_id != $_SESSION['user_id']) {
                # code...
                redirect('posts/edit');
            }
            # this method for add post in post model to add new record in databsse 
            # creat a array to put title and body for thie blog 

            $data = ['id' => $id,
                'title' => $post->title,
                'body' => $post->body];
            $this->view('posts/edit', $data);
        }

    }
    public function delete($id)
    {
        # this method for delete record from database...
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             //get existing post from model
             $post = $this->postModel->getPostsById($id);
             //check for Owner
             if ($post->users_id != $_SESSION['user_id']) {
                 # code...
                 redirect('posts/edit');
             }
            # code...
            if ($this->postModel->deletePost($id)) {
                # i ask about the delete querey in model post...
                flash('post_delete','The Record is deleted ...');
                redirect('posts');
            }else {
                # when the if isn't work...
                die('something is wrong');
            }
        } else {
            # code...
            redirect('posts');
        }
    }
}
?>