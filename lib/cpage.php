<?php
class cpage {
    private $title;
    private $content;
    private $file_name;
    private $view_name;

    public function __construct($fileName = Null, $title = Null) {
        $this->title = $title;
        $this->file_name = $fileName;
        $this->view_name = VIEW_PATH . str_replace(".php", ".view.php", $fileName);
    }

    public function __destruct() {
        // clean up here
    }

    public function render($page) {
        if ($this->title) {
            echo "<H1>{$this->title}</H1>";
        }
        if ($this->view_name) {
            require $this->view_name;
        }
    }
}
?>
