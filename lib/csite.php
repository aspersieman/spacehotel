<?php
/**
 * csite - a container for cpage objects
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
class csite {

    /**
     * An array of headers
     * @type array
     */
    private $headers;

    /**
     * An array of footers
     * @type array
     */
    private $footers;

    /**
     * The cpage object
     * @type cpage
     */
    private $page;

    /**
     * Constructor
     * @param bool $exceptions Should we throw external exceptions?
     */
    public function __construct($authenticate = False) {
        $this->headers = array();
        $this->footers = array();
        if ($authenticate) {
            $this->isAuthenticated();
        }
    }

    /**
     * Destructor.
     */
    public function __destruct() {
        // clean up here
    }

    /**
     * Render the headers, the view of the applicable page and then all the 
     * footers
     * @param cpage $page
     * @access public
     */
    public function render($page) {
        foreach($this->headers as $header) {
            include $header;
        }

        $this->page->render($page);

        foreach($this->footers as $footer) {
            include $footer;
        }
    }

    /**
     * Add header to the csite object
     * @param string $file
     * @access public
     */
    public function addHeader($file) {
        $this->headers[] = $file;
    }

    /**
     * Add footer to the csite object
     * @param string $file
     * @access public
     */
    public function addFooter($file) {
        $this->footers[] = $file;
    }

    /**
     * Set the page object to be rendered
     * @param cpage $page
     * @access public
     */
    public function setPage(cpage $page) {
        $this->page = $page;
    }

    /**
     * Check whether the current user is logged in
     * @access public
     */
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
