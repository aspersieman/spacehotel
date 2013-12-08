<?php
class csite {
    private $headers;
    private $footers;
    private $page;

    public function __construct($authenticate = False) {
        $this->headers = array();
        $this->footers = array();
        if ($authenticate) {
            $this->isAuthenticated();
        }
    }

    public function __destruct() {
        // clean up here
    }

    public function render($page) {
        foreach($this->headers as $header) {
            include $header;
        }

        $this->page->render($page);

        foreach($this->footers as $footer) {
            include $footer;
        }
    }

    public function addHeader($file) {
        $this->headers[] = $file;
    }

    public function addFooter($file) {
        $this->footers[] = $file;
    }

    public function setPage(cpage $page) {
        $this->page = $page;
    }

    public function isAuthenticated() {
        session_start();

        //Check whether the session variable user_id is present or not
        if(!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '')) {
            header("location: ../index.php");
            exit();
        }
    }
}
?>
