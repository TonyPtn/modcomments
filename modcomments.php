<?php
    class modComments extends Module
    {
        /* Attributes */

        /* Methods */

        public function __construct()
        {
            //Module technical name
            $this->name = 'modcomments';
            //Module category
            $this->tab ='front_office_features';
            //Module version
            $this->version = '0.1';
            //Module author
            $this->author = 'Tony Piton';
            //Module display name
            $this->displayName = $this->l('Comments module');
            //Module description
            $this->description = $this->l('This module allows customer to grade products and comment them.');
            //Set bootstrap utilisation
            $this->bootstrap = true;

            //Set minimum version
            $this->ps_version_compliancy = array('min' => '1.7');

            //Call parent construct
            parent::__construct();
        }

        //Hook install function
        public function install()
        {
            //Call parent install method
            parent::install();

            //Register module hook
            $this->registerHook('displayFooterProduct');
            //Register module hook header to add header files
            $this->registerHook('header');

            //Set install to true
            return true;
        }

        /*              Hook configuration                        */

        //Hook process function
        public function processFooterProduct()
        {
            //Check if comments is submited
            if(Tools::isSubmit('modcomment_pc_submit_comment'))
            {
                /* Retrieve values */
                //Retrieve id product
                $id_product = Tools::getValue('id_product');
                //Retrieve grade
                $grade = Tools::getValue('grade');
                //Retrieve comment
                $comment = Tools::getValue('comment');

                //Create values array to insert in database
                $insert = array(
                                    'id_product' => (int)$id_product,
                                    'grade' => (int)$grade,
                                    'comment' => pSQL($comment),
                                    'date_add' => date('Y-m-d H:i:s')
                                );

                //Insert values in database
                Db::getInstance()->insert('modcomments', $insert);

                //Set smarty confirmation value
                $this->context->smarty->assign('new_comment_posted', 'true');

            }
        }

        //Header hook display
        public function hookDisplayHeader()
        {
            /* Set css and js files */
            //Set css file
            $this->context->controller->addCSS($this->_path . 'views/css/modcomments.css', 'all');
            //Set js file
            $this->context->controller->addJS($this->_path . 'views/js/modcomments.js', 'all');
        }

        //Hook display assign function
        public function assignFooterProduct()
        {
            //Launch header display
            $this->hookDisplayHeader();

            //Retrieve product id
            $id_product = Tools::getValue('id_product');

            /* Retrieve database values */
            //Retrieve comments
            $comments = Db::getInstance()->executeS(
                'SELECT *
                FROM ' . _DB_PREFIX_ .'modcomments
                WHERE id_product = ' . (int)$id_product
            );

            /* Retrieve configuration values */
            //Retrieve enable grade value
            $enable_grades = Configuration::get('MODCOMMENTS_GRADES');
            //Retrieve enable comments value
            $enable_comments = Configuration::get('MODCOMMENTS_COMMENTS');

            /* Assign smarty values */
            //Asssign comments
            $this->context->smarty->assign('comments', $comments);
            //Assign enable grades value
            $this->context->smarty->assign('enable_grades', $enable_grades);
            //Assign enable comments value
            $this->context->smarty->assign('enable_comments', $enable_comments);
        }

        //Hook display function
        public function hookDisplayFooterProduct($params)
        {
            //Lauch hook process
            $this->processFooterProduct();
            //Lauch hook display assign
            $this->assignFooterProduct();

            //return template
            return $this->display(__FILE__, 'displayFooterProduct.tpl');
        }


        /*              Module configuration                        */

        //Configuration saving function
        public function processConfiguration()
        {
            //Check if config submited (POST or GET)
            if(Tools::isSubmit('submit_modcomments_form'))
            {
                /* Retrive configuration values */
                //Retrieve enable grades value
                $enable_grades = Tools::getValue('enable_grades');
                //Retrieve enable comments value
                $enable_comments = Tools::getValue('enable_commenents');

                /* Update (or set) configuration values*/
                //Set modcomments_grades configuration value
                Configuration::updateValue('MODCOMMENTS_GRADES', $enable_grades);
                //Set modcomments_comments configuration value
                Configuration::updateValue('MODCOMMENTS_COMMENTS', $enable_comments);

                //Assign Smart confirmation message
                $this->context->smarty->assign('confirmation', 'ok');
            }
        }

        //Retrieve configuration function
        public function assignConfiguration()
        {
            /* Retrieve configuration values */
            //Retrieve enables grades value
            $enable_grades = Configuration::get('MODCOMMENTS_GRADES');
            //Retrieve enables comments value
            $enable_comments = Configuration::get('MODCOMMENTS_COMMENTS');

            /* Set smarty configuration values */
            //Set enable grades value
            $this->context->smarty->assign('enable_grades', $enable_grades);
            //Set enable comments value
            $this->context->smarty->assign('enable_comments', $enable_comments);
        }

        //Create configuration page function
        public function getContent()
        {
            //Launch configuration saving
            $this->processConfiguration();
            //Launch configuration Retrieve
            $this->assignConfiguration();

            //Return smarty template file
            return $this->display(__FILE__, 'getContent.tpl');
        }
    }
 ?>
