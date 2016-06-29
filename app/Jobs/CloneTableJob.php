<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Scout\Service\CloneTable;

use App\Organization;

use App\Member;

use App\Scouter;

use App\Team;

use App\TeamMember;

use App\CoreOrganization;
use App\CoreMember;
use App\CoreTeam;
use App\CoreTeamMember;
use App\CoreScouter;

class CloneTableJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var CloneTable
     */
    protected $clone;

    /**
     * @var
     */
    protected $organization;


    /**
     * @var
     */
    protected $something;

    public function __construct(Organization $organization, CloneTable $clone)
    {
        $this->organization = $organization;
        $this->clone = $clone;


    }

    /**
     * Execute the job.
     * @param CloneTable $clone
     * @return void
     */
    public function handle(CloneTable $clone)
    {

        // related organization committe member
        // related team
        // related team member
        // related scouter

        $id = $this->organization->id;

        // Clone organization
        $this->cloneOrganization();

        // Clone Organization Commiitte Member
        $this->cloneMember();

        // Clone Scouter
        $this->cloneScouter();

        // Clone Team
        $this->cloneTeam();

        //  Clone Team Member
        $this->cloneTeammember($id);
    }

    /**
     * @param $id
     */
    public function getCloneModel($id){


        // related organization committe member
        // related team
        // related team member
        // related scouter

        $this->organization = Organization::find($id);

        // Clone organization
        $this->cloneOrganization();

        // Clone Organization Commiitte Member
        $this->cloneMember();

        // Clone Scouter
        $this->cloneScouter();

        // Clone Team
        $this->cloneTeam();

        //  Clone Team Member
        $this->cloneTeammember($id);

//        return redirect()->back();

    }

    /**
     *
     */
    public function cloneOrganization(){


        // Variable : manipulation
        $attributes = $this->organization->get_attributes();

        // new or overwrite data
        $this->clone->setOverwrite(
            array(
                'original_id'       => $this->organization->id,
                'registration_date' => formatDate($this->organization->registration_date)
            )
        );


        $this->clone->cloneObject($this->organization, $this->findAbstractModel('CoreOrganization'), $attributes);

        pre($this->clone->errors());

    }


    /**
     *
     */
    public function cloneMember()
    {

        $member = new Member;
        $cloningData = $this->organization->members->all();

        $finalOverwrite = array();

        foreach($cloningData as $data){
            $overwrites = array();
            $overwrites[] =  array('original_id' => $data->id);
            $finalOverwrite[] = $overwrites;
        }

        $this->clone->cloneMultipleObjects($cloningData, $this->findAbstractModel('CoreMember'), $member->get_attributes(), $finalOverwrite);

        pre($this->clone->errors());

    }

    /**
     *
     */
    public function cloneTeam()
    {

        $team = new Team;
        $cloningData = $this->organization->teams->all();
        $finalOverwrite = array();

        foreach($cloningData as $data){
            $overwrites = array();
            $overwrites[] = array('original_id' => $data->id);
            $finalOverwrite[] = $overwrites;
        }

        $this->clone->cloneMultipleObjects($cloningData, $this->findAbstractModel('CoreTeam'), $team->get_attributes(), $finalOverwrite);

        pre($this->clone->errors());

    }

    /**
     *
     */
    public function cloneScouter()
    {
        $scouter = new Scouter;
        $cloningData = $this->organization->scouters->all();

        $finalOverwrite = array();

        foreach($cloningData as $data){

            $overwrites = array();

            $overwrites[] = array('original_id' => $data->id);
            $overwrites[] = array('permission_date' => formatDate($data->permission_date));
            $overwrites[] = array('btc_date' => is_null($data->btc_date) ? null : formatDate($data->btc_date));
            $overwrites[] = array('advance_date' => is_null($data->advance_date) ? null : formatDate($data->advance_date));
            $overwrites[] = array('alt_date' => is_null($data->alt_date) ? null : formatDate($data->alt_date));
            $overwrites[] = array('lt_date' => is_null($data->lt_date) ? null : formatDate($data->lt_date));

            $finalOverwrite[] = $overwrites;

        }

        $this->clone->cloneMultipleObjects($cloningData, $this->findAbstractModel('CoreScouter'), $scouter->get_attributes(), $finalOverwrite);

        pre($this->clone->errors());

    }

    /**
     *
     */
    public function cloneTeammember()
    {


        $team_member = new TeamMember;

        // ===================
        $teams = $this->organization->teams->all();

        // This will hold array of TeamMember Objects
        $teamMembers = array();

        foreach($teams as $team){
            // each team is Team object

            $teamMembers[] = $team->teamMembers->all();

        }

        foreach($teamMembers as $teamMember){

            $final_overwrite = array();

            foreach($teamMember as $singleTeam){
                $overwrites = array();
                $overwrites[] = array('original_id' => $singleTeam->id);
                $overwrites[] = array('dob' => formatDate($singleTeam->dob));
                $overwrites[] = array('entry_date' => formatDate($singleTeam->entry_date));
                $overwrites[] = array('passed_date' => formatDate($singleTeam->passed_date));

                $final_overwrite[] = $overwrites;

            }

            $this->clone->cloneMultipleObjects($teamMember, $this->findAbstractModel('CoreTeamMember'), $team_member->get_attributes(), $final_overwrite);

//            pre($this->clone->errors());

        }
    }


    /**
     * @param $name
     * @return CoreMember|CoreOrganization|CoreScouter|CoreTeam|CoreTeamMember
     */
    private function findAbstractModel($name){

        switch ($name){
            case 'CoreOrganization':
                return new CoreOrganization;
                break;

            case 'CoreMember':
                return new CoreMember;
                break;

            case 'CoreTeam':
                return new CoreTeam;
                break;

            case 'CoreTeamMember':
                return new CoreTeamMember;
                break;

            case 'CoreScouter':
                return new CoreScouter;
                break;

        }
    }

}
