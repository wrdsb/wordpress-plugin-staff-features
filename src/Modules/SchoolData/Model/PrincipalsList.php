<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;

class PrincipalsList {
    public static function all() {
        $principals = [
            'bci' => 'Deborah Tyrrell &#60;deborah_tyrrell@wrdsb.ca&#62;',
            'chc' => 'David Wilson &#60;david_wilson@wrdsb.ca&#62;',
            'eci' => 'Ryan Hume &#60;ryan_hume@wrdsb.ca&#62;',
            'eds' => 'Brad Marsh &#60;brad_marsh@wrdsb.ca&#62;',
            'fhc' => 'Tina Rowe &#60;tina_rowe@wrdsb.ca&#62;',
            'gci' => 'Bryan Lozon &#60;bryan_lozon@wrdsb.ca&#62;',
            'gps' => 'Beverly Wood &#60;beverly_wood@wrdsb.ca&#62;',
            'grc' => 'Josh Windsor &#60;josh_windsor@wrdsb.ca&#62;',
            'hrh' => 'Jeff Klinck &#60;jeff_klinck@wrdsb.ca&#62;',
            'jhs' => 'Brenda Cathcart &#60;brenda_cathcart@wrdsb.ca&#62;',
            'kci' => 'Dennis Haid &#60;dennis_haid@wrdsb.ca&#62;',
            'phs' => 'Paula Bender &#60;paula_bender@wrdsb.ca&#62;',
            'jam' => 'Vida Collis &#60;vida_collis@wrdsb.ca&#62;',
            'sss' => 'Jennifer  &#60;jennifer_bistolas@wrdsb.ca&#62;',
            'wci' => 'Siobhan Watters &#60;siobhan_watters@wrdsb.ca&#62;',
            'wod' => 'Carolyn Salonen &#60;carolyn_salonen@wrdsb.ca&#62;',

            'alc' => 'Joe Bell &#60;joe_bell@wrdsb.ca&#62;',
            'alu' => 'Joe Bell &#60;joe_bell@wrdsb.ca&#62;',
            'cac' => 'Joe Bell &#60;joe_bell@wrdsb.ca&#62;',
            'utr' => 'Joe Bell &#60;joe_bell@wrdsb.ca&#62;',
            'acc' => 'Joe Bell &#60;joe_bell@wrdsb.ca&#62;',
            'acw' => 'Joe Bell &#60;joe_bell@wrdsb.ca&#62;',

            'ark' => 'Tatania Stroud &#60;tatania_stroud@wrdsb.ca&#62;',
            'abe' => 'Barb Brown &#60;barb_brown@wrdsb.ca&#62;',
            'alp' => 'Lucinda Foss-Silveira &#60;lucinda_foss-silveira@wrdsb.ca&#62;',
            'ave' => 'Marc Lehman &#60;marc_lehmann@wrdsb.ca&#62;',
            'ayr' => 'Paul Milne &#60;paul_milne@wrdsb.ca&#62;',
            'bdn' => 'Ryan Day &#60;ryan_day@wrdsb.ca&#62;',
            'blr' => 'Marc Vender &#60;marc_vender@wrdsb.ca&#62;',
            'bre' => 'Michelle Schmidt &#60;michelle_schmid@wrdsb.ca&#62;',
            'brp' => 'Murray Crewson &#60;murray_crewson@wrdsb.ca&#62;',
            'bgd' => 'Rick Saunders &#60;rick_saunders@wrdsb.ca&#62;',
            'cdc' => 'Sherri Davidson &#60;sherri_davidson@wrdsb.ca&#62;',
            'ced' => 'Julie Weber &#60;julie_weber@wrdsb.ca&#62;',
            'cnc' => 'Meghan Reis &#60;meghan_reis@wrdsb.ca&#62;',
            'cnw' => 'Stephen Sherlock &#60;stephen_sherlock@wrdsb.ca&#62;',
            'ctr' => 'Kimberly Freeman &#60;kimberly_freeman@wrdsb.ca&#62;',
            'cha' => 'Sharon Morgan &#60;sharon_morgan@wrdsb.ca&#62;',
            'chi' => 'Jenni Guy &#60;jenni_guy@wrdsb.ca&#62;',
            'cle' => 'Vinay Tiwari &#60;vinay_tiwari@wrdsb.ca&#62;',
            'con' => 'Michael Sendrea &#60;michael_sendrea@wrdsb.ca&#62;',
            'cor' => 'Samantha Hutton-Walker &#60;samantha_hutton-walker@wrdsb.ca&#62;',
            'coh' => 'Leslie McNabb &#60;leslie_mcnabb@wrdsb.ca&#62;',
            'crl' => 'Mike Coates &#60;mike_coates@wrdsb.ca&#62;',
            'cre' => 'Christopher Greenhough &#60;christopher_greenhough@wrdsb.ca&#62;',
            'dlf' => 'Karin Bileski &#60;karin_bileski@wrdsb.ca&#62;',
            'dli' => 'Erin Bell &#60;erin_bell@wrdsb.ca&#62;',
            'dls' => 'Jennifer Bistolas &#60;jennifer_bistolas@wrdsb.ca&#62;',
            'doo' => 'Beverlie Stewart &#60;beverlie_stewart@wrdsb.ca&#62;',
            'dpk' => 'Jeff Bumstead &#60;jeff_bumstead@wrdsb.ca&#62;',
            'est' => 'Chris Eaton &#60;chris_eaton@wrdsb.ca&#62;',
            'elg' => 'Tracy Scott &#60;tracy_scott@wrdsb.ca&#62;',
            'elz' => 'Sara MacNeill &#60;sara_macneill@wrdsb.ca&#62;',
            'emp' => 'Krista Mohr Beamish &#60;krista_mohrbeamish@wrdsb.ca&#62;',
            'flo' => 'Shawn Thompson &#60;shawn_thompson@wrdsb.ca&#62;',
            'fgl' => 'Tamara Kaufman &#60;tamara_kaufman@wrdsb.ca&#62;',
            'fhl' => 'Brad Hughes &#60;brad_hughes@wrdsb.ca&#62;',
            'fra' => 'Linda Cotnam &#60;linda_cotnam@wrdsb.ca&#62;',
            'gcp' => 'Mary Sue Meredith &#60;mary_sue_meredith@wrdsb.ca&#62;',
            'gro' => 'Laura Griffin &#60;laura_griffin@wrdsb.ca&#62;',
            'gvc' => 'Jenni-Rebecca Baer &#60;jenni-rebecca_baer@wrdsb.ca&#62;',
            'gvn' => 'Nick Chiarelli &#60;nick_chiarelli@wrdsb.ca&#62;',
            'hes' => 'Rebecca Jutzi &#60;rebecca_jutzi@wrdsb.ca&#62;',
            'hig' => 'Sean Finn &#60;sean_finn@wrdsb.ca&#62;',
            'hil' => 'Vlad Kovac &#60;vlad_kovac@wrdsb.ca&#62;',
            'how' => 'Steve Lipskie &#60;steve_lipskie@wrdsb.ca&#62;',
            'jfc' => 'Paul Fracas &#60;leah_pullen@wrdsb.ca&#62;',
            'jwg' => 'Marc Laurente &#60;marc_laurente@wrdsb.ca&#62;',
            'jme' => 'Janet Hale &#60;janet_hale@wrdsb.ca&#62;',
            'jst' => 'Andrea Michelutti &#60;andrea_michelutti@wrdsb.ca&#62;',
            'jdp' => 'Holly Smith &#60;holly_smith@wrdsb.ca&#62;',
            'jma' => 'Pamela Mustin &#60;pamela_mustin@wrdsb.ca&#62;',
            'kea' => 'Scott Dowling &#60;scott_dowling@wrdsb.ca&#62;',
            'ked' => 'Brian Weigel &#60;brian_weigel@wrdsb.ca&#62;',
            'lkw' => 'Julie Jackson Sinclair &#60;julie_jacksonsinclair@wrdsb.ca&#62;',
            'lrw' => 'Dan Enns &#60;dan_enns@wrdsb.ca&#62;',
            'lau' => 'Matthew Cain &#60;matthew_cain@wrdsb.ca&#62;',
            'lbp' => 'Jill Colyer &#60;jill_colyer@wrdsb.ca&#62;',
            'lex' => 'Barb Tomkins &#60;barb_tomkins@wrdsb.ca&#62;',
            'lnh' => 'Paul Schlegel &#60;paul_schlegel@wrdsb.ca&#62;',
            'lin' => 'Peter Trybus &#60;peter_trybus@wrdsb.ca&#62;',
            'mcg' => 'Christine Hristov &#60;christine_hristov@wrdsb.ca&#62;',
            'mck' => 'Kathryn Haddock &#60;kathryn_haddock@wrdsb.ca&#62;',
            'man' => 'Stephanie Munro &#60;stephanie_munro@wrdsb.ca&#62;',
            'mrg' => 'Silvana Hoxha &#60;silvana_hoxha@wrdsb.ca&#62;',
            'mjp' => 'Tim Pugh &#60;tim_pugh@wrdsb.ca&#62;',
            'mea' => 'Phillip Sallewsky &#60;phillip_sallewsky@wrdsb.ca&#62;',
            'mil' => 'Susan Schaffner &#60;susan_schaffner@wrdsb.ca&#62;',
            'mof' => 'Erica Gillespie &#60;erica_gillespie@wrdsb.ca&#62;',
            'nam' => 'Afrim Ficic &#60;afrim_ficic@wrdsb.ca&#62;',
            'ndd' => 'Katie Brown &#60;katie_brown@wrdsb.ca&#62;',
            'nlw' => 'Dave Glebe &#60;dave_glebe@wrdsb.ca&#62;',
            'oak' => 'Jeff Johnson &#60;jeff_johnson@wrdsb.ca&#62;',
            'pkm' => 'Andy Lavell &#60;andy_lavell@wrdsb.ca&#62;',
            'pkw' => 'Melissa Stacey &#60;melissa_stacey@wrdsb.ca&#62;',
            'pio' => 'Tracy Tait &#60;tracy_tait@wrdsb.ca&#62;',
            'pre' => 'Mark McMath &#60;mark_mcmath@wrdsb.ca&#62;',
            'pru' => 'Sharlene McHolm &#60;sharlene_mcholm@wrdsb.ca&#62;',
            'qel' => 'Kathy Mathers &#60;kathy_mathers@wrdsb.ca&#62;',
            'qsm' => 'Paul Fracas &#60;paul_fracas@wrdsb.ca&#62;',
            'riv' => 'Lynda Trudeau &#60;lynda_trudeau@wrdsb.ca&#62;',
            'roc' => 'Bobbi Jo Lovell &#60;bobbie-jo_lovell@wrdsb.ca&#62;',
            'rmt' => 'Karen Moore &#60;karen_moore@wrdsb.ca&#62;',
            'rye' => 'Liz Arbuckle &#60;liz_arbuckle@wrdsb.ca&#62;',
            'sag' => 'Valerie Martin &#60;valerie_martin@wrdsb.ca&#62;',
            'shl' => 'Nancy Murovec &#60;nancy_murovec@wrdsb.ca&#62;',
            'snd' => 'Danielle Holden &#60;danielle_holden@wrdsb.ca&#62;',
            'she' => 'Christina Webster &#60;christina_webster@wrdsb.ca&#62;',
            'sil' => 'Jason Stere &#60;jason_stere@wrdsb.ca&#62;',
            'sab' => 'Rebecca Bearinger Fay &#60;rebecca_bearinger_fay@wrdsb.ca&#62;',
            'smi' => 'Heidi Mannhardt-Zender &#60;heidi_mannhardt-zender@wrdsb.ca&#62;',
            'srg' => 'Taryn Dowsling &#60;taryn_dowsling@wrdsb.ca&#62;',
            'sta' => 'Amanda Matessich &#60;amanda_matessich@wrdsb.ca&#62;',
            'stj' => 'Amy Humphrys &#60;amy_humphrys@wrdsb.ca&#62;',
            'stn' => 'Nancy Woodhall &#60;nancy_woodhall@wrdsb.ca&#62;',
            'stw' => 'Carol Coyle &#60;carol_coyle@wrdsb.ca&#62;',
            'sud' => 'Rita Givlin &#60;rita_givlin@wrdsb.ca&#62;',
            'sun' => 'Julia Passmore &#60;julia_passmore@wrdsb.ca&#62;',
            'tai' => 'Heather Schumann &#60;heather_schumann@wrdsb.ca&#62;',
            'tri' => 'Siobhan Shonk &#60;siobhan_shonk@wrdsb.ca&#62;',
            'vis' => 'Penny Miller &#60;penny_miller@wrdsb.ca&#62;',
            'wel' => 'Brian Beney &#60;brian_beney@wrdsb.ca&#62;',
            'wsh' => 'Sofia Brock &#60;sofia_brock@wrdsb.ca&#62;',
            'wsm' => 'Jennifer Crits &#60;jennifer_crits@wrdsb.ca&#62;',
            'wsv' => 'Jodie Hancox-Meyer &#60;jodie_hancox-meyer@wrdsb.ca&#62;',
            'wlm' => 'Liz Anderson &#60;liz_anderson@wrdsb.ca&#62;',
            'wls' => 'Elizabeth Martz &#60;elizabeth_martz@wrdsb.ca&#62;',
            'wcp' => 'Pat Dale &#60;pat_dale@wrdsb.ca&#62;',
            'wgd' => 'Jeffery Adam &#60;jeffery_adam@wrdsb.ca&#62;',
            'wtt' => 'Sandra Himann &#60;sandra_himann@wrdsb.ca&#62;',
            'wpk' => 'Jill Strome &#60;jill_strome@wrdsb.ca&#62;'
        ];

        return $principals;
    }
}
