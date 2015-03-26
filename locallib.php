<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This file contains the definition for the library class for file feedback plugin
 *
 *
 * @package   assignfeedback_codehandin
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

// File areas for file feedback assignment.
define('ASSIGNFEEDBACK_CHIF_FILEAREA', 'assignfeedback_codehandin');
//define('ASSIGNFEEDBACK_CHIF_BATCH_FILEAREA', 'feedback_codehandins_batch');
//define('ASSIGNFEEDBACK_CHIF_IMPORT_FILEAREA', 'feedback_codehandins_import');
//define('ASSIGNFEEDBACK_CHIF_MAXSUMMARYFILES', 5);
//define('ASSIGNFEEDBACK_CHIF_MAXSUMMARYUSERS', 5);
//define('ASSIGNFEEDBACK_CHIF_MAXFILEUNZIPTIME', 120);

/**
 * Library class for file feedback plugin extending feedback plugin base class.
 *
 * @package   assignfeedback_codehandin
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class assign_feedback_codehandin extends assign_feedback_plugin {

    
    
    /**
     * Get the name of the file feedback plugin.
     *
     * @return string
     */
    public function get_name() {
        return get_string('codehandin', 'assignfeedback_codehandin');
    }

//    /**
//     * Get file feedback information from the database.
//     *
//     * @param int $gradeid
//     * @return mixed
//     */
//    public function get_codehandin_feedback($gradeid) {
//        global $DB;
//        return $DB->get_record('assignfeedback_codehandin', array('grade' => $gradeid));
//    }

    //there are no files for the feedback area!
//    /**
//     * File format options.
//     *
//     * @return array
//     */
//    private function get_codehandin_options() {
//        global $COURSE;
//
//        $fileoptions = array('subdirs'=>1,
//                             'maxbytes'=>$COURSE->maxbytes,
//                             'accepted_types'=>'*',
//                             'return_types'=>FILE_INTERNAL);
//        return $fileoptions;
//    }



    public function add_grade_form_elements(MoodleQuickForm $mform, stdClass $data, $params) {
        $mform->addElement('submit', 'submit', 'CodeHandIn Grade');
        $mform->addElement('textarea', 'introduction', get_string("introtext", "survey"), 'wrap="virtual" rows="20" cols="50"');
        return true;
    }

    /**
     * Get form elements for grading form.
     *
     * @param stdClass $grade
     * @param MoodleQuickForm $mform
     * @param stdClass $data
     * @param int $userid The userid we are currently grading
     * @return bool true if elements were added to the form
     */
    public function get_form_elements_for_user($grade, MoodleQuickForm $mform, stdClass $data, $userid) {

        //$fileoptions = $this->get_codehandin_options();
        //$gradeid = $grade ? $grade->id : 0;
        //$elementname = 'files_' . $userid;
        //$data = file_prepare_standard_codehandinmanager($data,
        //                                          $elementname,
        //                                         $fileoptions,
        //                                          $this->assignment->get_context(),
        //                                          'assignfeedback_codehandin',
        //                                          ASSIGNFEEDBACK_FILE_FILEAREA,
        //                                          $gradeid);
        //$mform->addElement('filemanager', $elementname . '_codehandinmanager', $this->get_name(), null, $fileoptions);


        $gradearray = array();
        $gradearray[] = & $mform->createElement('text', 'autograde', 'style grade');
        $mform->setType('autograde', PARAM_INT);
        $gradearray[] = & $mform->createElement('static', 'maxautomarks', '', ' of a possible ' . '85' . ' marks');
        $mform->addGroup($gradearray, 'autoarray', 'CodeHandIn functional mark', array(''), false);


        $mform->addElement('textarea', 'code', 'file contents');
        $mform->setType('code', PARAM_TEXT);

        $gradearray = array();
        $gradearray[] = & $mform->createElement('text', 'sytlegrade', 'style grade');
        $mform->setType('sytlegrade', PARAM_INT);
        $gradearray[] = & $mform->createElement('static', 'maxstylemarks', '', ' of a possible ' . '15' . ' marks');
        $mform->addGroup($gradearray, 'stylearray', 'style mark', array(''), false);



        return true;
    }

//    /**
//     * Count the number of files.
//     *
//     * @param int $gradeid
//     * @param string $area
//     * @return int
//     */
//    private function count_codehandins($gradeid, $area) {
//
//        $fs = get_file_storage();
//        $files = $fs->get_area_files($this->assignment->get_context()->id, 'assignfeedback_codehandin', $area, $gradeid, 'id', false);
//
//        return count($files);
//    }

    /**
     * Update the number of files in the file area.
     *
     * @param stdClass $grade The grade record
     * @return bool - true if the value was saved
     */
//    public function update_codehandin_count($grade) {
//        global $DB;
//
//        $filefeedback = $this->get_codehandin_feedback($grade->id);
//        if ($filefeedback) {
//            $filefeedback->numfiles = $this->count_codehandins($grade->id, ASSIGNFEEDBACK_FILE_FILEAREA);
//            return $DB->update_record('assignfeedback_codehandin', $filefeedback);
//        } else {
//            $filefeedback = new stdClass();
//            $filefeedback->numfiles = $this->count_codehandins($grade->id, ASSIGNFEEDBACK_FILE_FILEAREA);
//            $filefeedback->grade = $grade->id;
//            $filefeedback->assignment = $this->assignment->get_instance()->id;
//            return $DB->insert_record('assignfeedback_codehandin', $filefeedback) > 0;
//        }
//    }

    /**
     * Save the feedback files.
     *
     * @param stdClass $grade
     * @param stdClass $data
     * @return bool
     */
    public function save(stdClass $grade, stdClass $data) {
//        $fileoptions = $this->get_codehandin_options();
//
//        // The element name may have been for a different user.
//        foreach ($data as $key => $value) {
//            if (strpos($key, 'files_') === 0 && strpos($key, '_codehandinmanager')) {
//                $elementname = substr($key, 0, strpos($key, '_codehandinmanager'));
//            }
//        }
//
//        $data = file_postupdate_standard_codehandinmanager($data, $elementname, $fileoptions, $this->assignment->get_context(), 'assignfeedback_codehandin', ASSIGNFEEDBACK_FILE_FILEAREA, $grade->id);
//
//        return $this->update_codehandin_count($grade);
    }

//    /**
//     * Display the list of files in the feedback status table.
//     * @todo add grade info to display
//     * @param stdClass $grade
//     * @param bool $showviewlink - Set to true to show a link to see the full list of files
//     * @return string
//     */
//    public function view_summary(stdClass $grade, & $showviewlink) {
//
//
//    }

//    /**
//     * Display the list of files in the feedback status table.
//     *
//     * @param stdClass $grade
//     * @return string
//     */
//    public function view(stdClass $grade) {
//        return $this->assignment->render_area_codehandins('assignfeedback_codehandin', ASSIGNFEEDBACK_FILE_FILEAREA, $grade->id);
//    }

//    /**
//     * The assignment has been deleted - cleanup.
//     *
//     * @return bool
//     */
//    public function delete_instance() {
//        global $DB;
//        // Will throw exception on failure.
//        $DB->delete_records('assignfeedback_codehandin', array('assignment' => $this->assignment->get_instance()->id));
//
//        return true;
//    }

//    /**
//     * Return true if there are no feedback files.
//     *
//     * @param stdClass $grade
//     */
//    public function is_empty(stdClass $grade) {
//        return $this->count_codehandins($grade->id, ASSIGNFEEDBACK_FILE_FILEAREA) == 0;
//    }

    /**
     * Get file areas returns a list of areas this plugin stores files.
     *
     * @return array - An array of fileareas (keys) and descriptions (values)
     */
    public function get_codehandin_areas() {
        return array(ASSIGNFEEDBACK_FILE_FILEAREA => $this->get_name());
    }

    /**
     * Return true if this plugin can upgrade an old Moodle 2.2 assignment of this type
     * and version.
     *
     * @param string $type old assignment subtype
     * @param int $version old assignment version
     * @return bool True if upgrade is possible
     */
    public function can_upgrade($type, $version) {
        if (($type == 'upload' || $type == 'uploadsingle') && $version >= 2011112900) {
            return true;
        }
        return false;
    }

    /**
     * Upgrade the settings from the old assignment to the new plugin based one.
     *
     * @param context $oldcontext - the context for the old assignment
     * @param stdClass $oldassignment - the data for the old assignment
     * @param string $log - can be appended to by the upgrade
     * @return bool was it a success? (false will trigger a rollback)
     */
    public function upgrade_settings(context $oldcontext, stdClass $oldassignment, & $log) {
        // First upgrade settings (nothing to do).
        return true;
    }

    /**
     * Upgrade the feedback from the old assignment to the new one.
     *
     * @param context $oldcontext - the database for the old assignment context
     * @param stdClass $oldassignment The data record for the old assignment
     * @param stdClass $oldsubmission The data record for the old submission
     * @param stdClass $grade The data record for the new grade
     * @param string $log Record upgrade messages in the log
     * @return bool true or false - false will trigger a rollback
     */
    public function upgrade(context $oldcontext, stdClass $oldassignment, stdClass $oldsubmission, stdClass $grade, & $log) {
        global $DB;
        return true;
    }

    /**
     * Return a list of the batch grading operations performed by this plugin.
     * This plugin supports batch upload files and upload zip.
     *
     * @return array The list of batch grading operations
     */
    public function get_grading_batch_operations() {
        return array('uploadfiles' => get_string('uploadfiles', 'assignfeedback_codehandin'), 'CHIGA' => 'CodeHandIn Grade All', 'CHIGS' => 'CodeHandIn Grade Selected');
    }

//    /**
//     * Upload files and send them to multiple users.
//     *
//     * @param array $users - An array of user ids
//     * @return string - The response html
//     */
//    public function view_batch_upload_codehandins($users) {
//        global $CFG, $DB, $USER;
//
//        require_capability('mod/assign:grade', $this->assignment->get_context());
//        require_once($CFG->dirroot . '/mod/assign/feedback/file/batchuploadfilesform.php');
//        require_once($CFG->dirroot . '/mod/assign/renderable.php');
//
//        $formparams = array('cm' => $this->assignment->get_course_module()->id,
//            'users' => $users,
//            'context' => $this->assignment->get_context());
//
//        $usershtml = '';
//
//        $usercount = 0;
//        foreach ($users as $userid) {
//            if ($usercount >= ASSIGNFEEDBACK_FILE_MAXSUMMARYUSERS) {
//                $moreuserscount = count($users) - ASSIGNFEEDBACK_FILE_MAXSUMMARYUSERS;
//                $usershtml .= get_string('moreusers', 'assignfeedback_codehandin', $moreuserscount);
//                break;
//            }
//            $user = $DB->get_record('user', array('id' => $userid), '*', MUST_EXIST);
//
//            $usersummary = new assign_user_summary($user, $this->assignment->get_course()->id, has_capability('moodle/site:viewfullnames', $this->assignment->get_course_context()), $this->assignment->is_blind_marking(), $this->assignment->get_uniqueid_for_user($user->id), get_extra_user_fields($this->assignment->get_context()));
//            $usershtml .= $this->assignment->get_renderer()->render($usersummary);
//            $usercount += 1;
//        }
//
//        $formparams['usershtml'] = $usershtml;
//
//        $mform = new assignfeedback_codehandin_batch_upload_codehandins_form(null, $formparams);
//
//        if ($mform->is_cancelled()) {
//            redirect(new moodle_url('view.php', array('id' => $this->assignment->get_course_module()->id,
//                'action' => 'grading')));
//            return;
//        } else if ($data = $mform->get_data()) {
//            // Copy the files from the draft area to a temporary import area.
//            $data = file_postupdate_standard_codehandinmanager($data, 'files', $this->get_codehandin_options(), $this->assignment->get_context(), 'assignfeedback_codehandin', ASSIGNFEEDBACK_FILE_BATCH_FILEAREA, $USER->id);
//            $fs = get_codehandin_storage();
//
//            // Now copy each of these files to the users feedback file area.
//            foreach ($users as $userid) {
//                $grade = $this->assignment->get_user_grade($userid, true);
//                $this->assignment->notify_grade_modified($grade);
//
//                $this->copy_area_codehandins($fs, $this->assignment->get_context()->id, 'assignfeedback_codehandin', ASSIGNFEEDBACK_FILE_BATCH_FILEAREA, $USER->id, $this->assignment->get_context()->id, 'assignfeedback_codehandin', ASSIGNFEEDBACK_FILE_FILEAREA, $grade->id);
//
//                $filefeedback = $this->get_codehandin_feedback($grade->id);
//                if ($filefeedback) {
//                    $filefeedback->numfiles = $this->count_codehandins($grade->id, ASSIGNFEEDBACK_FILE_FILEAREA);
//                    $DB->update_record('assignfeedback_codehandin', $filefeedback);
//                } else {
//                    $filefeedback = new stdClass();
//                    $filefeedback->numfiles = $this->count_codehandins($grade->id, ASSIGNFEEDBACK_FILE_FILEAREA);
//                    $filefeedback->grade = $grade->id;
//                    $filefeedback->assignment = $this->assignment->get_instance()->id;
//                    $DB->insert_record('assignfeedback_codehandin', $filefeedback);
//                }
//            }
//
//            // Now delete the temporary import area.
//            $fs->delete_area_codehandins($this->assignment->get_context()->id, 'assignfeedback_codehandin', ASSIGNFEEDBACK_FILE_BATCH_FILEAREA, $USER->id);
//
//            redirect(new moodle_url('view.php', array('id' => $this->assignment->get_course_module()->id,
//                'action' => 'grading')));
//            return;
//        } else {
//
//            $header = new assign_header($this->assignment->get_instance(), $this->assignment->get_context(), false, $this->assignment->get_course_module()->id, get_string('batchuploadfiles', 'assignfeedback_codehandin'));
//            $o = '';
//            $o .= $this->assignment->get_renderer()->render($header);
//            $o .= $this->assignment->get_renderer()->render(new assign_form('batchuploadfiles', $mform));
//            $o .= $this->assignment->get_renderer()->render_footer();
//        }
//
//        return $o;
//    }

    /**
     * User has chosen a custom grading batch operation and selected some users.
     *
     * @param string $action - The chosen action
     * @param array $users - An array of user ids
     * @return string - The response html
     */
    public function grading_batch_operation($action, $users) {

        if ($action == 'uploadfiles') {
            return $this->view_batch_upload_codehandins($users);
        }
        return '';
    }

//    /**
//     * View the upload zip form.
//     *
//     * @return string - The html response
//     */
//    public function view_upload_zip() {
//        global $CFG, $USER;
//
//        require_capability('mod/assign:grade', $this->assignment->get_context());
//        require_once($CFG->dirroot . '/mod/assign/feedback/file/uploadzipform.php');
//        require_once($CFG->dirroot . '/mod/assign/feedback/file/importziplib.php');
//        require_once($CFG->dirroot . '/mod/assign/feedback/file/importzipform.php');
//
//        $formparams = array('context' => $this->assignment->get_context(),
//            'cm' => $this->assignment->get_course_module()->id);
//        $mform = new assignfeedback_codehandin_upload_zip_form(null, $formparams);
//
//        $o = '';
//
//        $confirm = optional_param('confirm', 0, PARAM_BOOL);
//        $renderer = $this->assignment->get_renderer();
//
//        // Delete any existing files.
//        $importer = new assignfeedback_codehandin_zip_importer();
//        $contextid = $this->assignment->get_context()->id;
//
//        if ($mform->is_cancelled()) {
//            $importer->delete_import_codehandins($contextid);
//            $urlparams = array('id' => $this->assignment->get_course_module()->id,
//                'action' => 'grading');
//            $url = new moodle_url('view.php', $urlparams);
//            redirect($url);
//            return;
//        } else if ($confirm) {
//            $params = array('assignment' => $this->assignment, 'importer' => $importer);
//
//            $mform = new assignfeedback_codehandin_import_zip_form(null, $params);
//            if ($mform->is_cancelled()) {
//                $importer->delete_import_codehandins($contextid);
//                $urlparams = array('id' => $this->assignment->get_course_module()->id,
//                    'action' => 'grading');
//                $url = new moodle_url('view.php', $urlparams);
//                redirect($url);
//                return;
//            }
//
//            $o .= $importer->import_zip_codehandins($this->assignment, $this);
//            $importer->delete_import_codehandins($contextid);
//        } else if (($data = $mform->get_data()) &&
//                ($zipfile = $mform->save_stored_codehandin('feedbackzip', $contextid, 'assignfeedback_codehandin', ASSIGNFEEDBACK_FILE_IMPORT_FILEAREA, $USER->id, '/', 'import.zip', true))) {
//
//            $importer->extract_codehandins_from_zip($zipfile, $contextid);
//
//            $params = array('assignment' => $this->assignment, 'importer' => $importer);
//
//            $mform = new assignfeedback_codehandin_import_zip_form(null, $params);
//
//            $header = new assign_header($this->assignment->get_instance(), $this->assignment->get_context(), false, $this->assignment->get_course_module()->id, get_string('confirmuploadzip', 'assignfeedback_codehandin'));
//            $o .= $renderer->render($header);
//            $o .= $renderer->render(new assign_form('confirmimportzip', $mform));
//            $o .= $renderer->render_footer();
//        } else {
//
//            $header = new assign_header($this->assignment->get_instance(), $this->assignment->get_context(), false, $this->assignment->get_course_module()->id, get_string('uploadzip', 'assignfeedback_codehandin'));
//            $o .= $renderer->render($header);
//            $o .= $renderer->render(new assign_form('uploadfeedbackzip', $mform));
//            $o .= $renderer->render_footer();
//        }
//
//        return $o;
//    }

    /**
     * Called by the assignment module when someone chooses something from the
     * grading navigation or batch operations list.
     *
     * @param string $action - The page to view
     * @return string - The html response
     */
    public function view_page($action) {
        if ($action == 'CHIGA') {            
            return $this->grade_all();
        }
        if ($action == 'CHIGS') {
            $users = required_param('selectedusers', PARAM_SEQUENCE);
            return $this->grade_selected(explode(',', $users));
        }
        return '';
    }

    /**
     * Return a list of the grading actions performed by this plugin.
     * This plugin supports upload zip.
     *
     * @return array The list of grading actions
     */
    public function get_grading_actions() {
        return array('CHIGA' => 'CodeHandIn Grade All', 'CHIGS' => 'CodeHandIn Grade Selected');
    }

//    /**
//     * @todo add some external params
//     * @return external_description|null
//     */
//    public function get_external_parameters() {
//        return array(
//        );
//    }

}
