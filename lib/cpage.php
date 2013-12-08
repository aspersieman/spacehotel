<?php
/**
 * cpage - object to accept and render a page's view
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
class cpage {

    /**
     * The title of the page
     * @type string
     */
    private $title;

    /**
     * The filename of the main page that contains the page logic
     * @type string
     */
    private $file_name;

    /**
     * The filename of the view page that contains the display information
     * @type string
     */
    private $view_name;

    /**
     * Constructor
     * @param bool $exceptions Should we throw external exceptions?
     */
    public function __construct($fileName = Null, $title = Null) {
        $this->title = $title;
        $this->file_name = $fileName;
        $this->view_name = VIEW_PATH . str_replace(".php", ".view.php", $fileName);
    }

    /**
     * Destructor.
     */
    public function __destruct() {
        // clean up here
    }

    /**
     * Render the view of the applicable page
     * @param cpage $page
     * @access public
     */
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
