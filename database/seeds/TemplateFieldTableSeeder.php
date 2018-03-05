<?php

use Illuminate\Database\Seeder;

class TemplateFieldTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('template_field')->delete();
        
        \DB::table('template_field')->insert(array (
            0 => 
            array (
                'id' => 1,
                'template_group_id' => 1,
                'title' => 'customer_domain',
                'html_label' => 'Customer Domain',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'url',
            ),
            1 => 
            array (
                'id' => 2,
                'template_group_id' => 1,
                'title' => 'main_text',
                'html_label' => 'Main Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:100',
            ),
            2 => 
            array (
                'id' => 3,
                'template_group_id' => 1,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            3 => 
            array (
                'id' => 4,
                'template_group_id' => 1,
                'title' => 'background',
                'html_label' => 'Background',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            4 => 
            array (
                'id' => 5,
                'template_group_id' => 1,
                'title' => 'text_color',
                'html_label' => 'Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'template_group_id' => 1,
                'title' => 'intro',
                'html_label' => 'Intro',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            6 => 
            array (
                'id' => 7,
                'template_group_id' => 2,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            7 => 
            array (
                'id' => 8,
                'template_group_id' => 2,
                'title' => 'photo',
                'html_label' => 'Photo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            8 => 
            array (
                'id' => 9,
                'template_group_id' => 3,
                'title' => 'endlogo',
                'html_label' => 'End Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            9 => 
            array (
                'id' => 10,
                'template_group_id' => 3,
                'title' => 'slogan',
                'html_label' => 'Slogan',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            10 => 
            array (
                'id' => 11,
                'template_group_id' => 3,
                'title' => 'hoodText',
                'html_label' => 'Hood Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            11 => 
            array (
                'id' => 12,
                'template_group_id' => 3,
                'title' => 'sideText1',
                'html_label' => 'Slide Text 1',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            12 => 
            array (
                'id' => 13,
                'template_group_id' => 3,
                'title' => 'sideText2',
                'html_label' => 'Slide Text 2',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            13 => 
            array (
                'id' => 14,
                'template_group_id' => 3,
                'title' => 'sideText3',
                'html_label' => 'Slide Text 3',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            14 => 
            array (
                'id' => 15,
                'template_group_id' => 3,
                'title' => 'carColor',
                'html_label' => 'Car Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            15 => 
            array (
                'id' => 16,
                'template_group_id' => 4,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            16 => 
            array (
                'id' => 17,
                'template_group_id' => 5,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            17 => 
            array (
                'id' => 18,
                'template_group_id' => 5,
                'title' => 'text',
                'html_label' => 'Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:100',
            ),
            18 => 
            array (
                'id' => 19,
                'template_group_id' => 6,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            19 => 
            array (
                'id' => 20,
                'template_group_id' => 7,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            20 => 
            array (
                'id' => 21,
                'template_group_id' => 8,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            21 => 
            array (
                'id' => 22,
                'template_group_id' => 9,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            22 => 
            array (
                'id' => 23,
                'template_group_id' => 10,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            23 => 
            array (
                'id' => 24,
                'template_group_id' => 10,
                'title' => 'text',
                'html_label' => 'Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:100',
            ),
            24 => 
            array (
                'id' => 25,
                'template_group_id' => 11,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            25 => 
            array (
                'id' => 26,
                'template_group_id' => 12,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            26 => 
            array (
                'id' => 27,
                'template_group_id' => 13,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            27 => 
            array (
                'id' => 28,
                'template_group_id' => 14,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            28 => 
            array (
                'id' => 29,
                'template_group_id' => 15,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            29 => 
            array (
                'id' => 30,
                'template_group_id' => 16,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            30 => 
            array (
                'id' => 31,
                'template_group_id' => 17,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            31 => 
            array (
                'id' => 32,
                'template_group_id' => 18,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            32 => 
            array (
                'id' => 33,
                'template_group_id' => 19,
                'title' => 'logo',
                'html_label' => 'Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            33 => 
            array (
                'id' => 34,
                'template_group_id' => 20,
                'title' => 'customerLogo',
                'html_label' => 'Customer Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            34 => 
            array (
                'id' => 35,
                'template_group_id' => 20,
                'title' => 'customerLogoText',
                'html_label' => 'Customer Logo Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            35 => 
            array (
                'id' => 36,
                'template_group_id' => 20,
                'title' => 'brandLogo1',
                'html_label' => 'Brand Logo 1',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            36 => 
            array (
                'id' => 37,
                'template_group_id' => 20,
                'title' => 'brandLogo1Text1',
                'html_label' => 'Brand Logo 1 Text 1',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            37 => 
            array (
                'id' => 38,
                'template_group_id' => 20,
                'title' => 'brandLogo1Text2',
                'html_label' => 'Brand Logo 1 Text 2',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            38 => 
            array (
                'id' => 39,
                'template_group_id' => 20,
                'title' => 'brandLogo1Text3',
                'html_label' => 'Brand Logo 1 Text 3',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            39 => 
            array (
                'id' => 40,
                'template_group_id' => 20,
                'title' => 'shot2',
                'html_label' => 'Shot 2',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            40 => 
            array (
                'id' => 41,
                'template_group_id' => 20,
                'title' => 'brandLogo1Text1Color',
                'html_label' => 'Brand Logo 1 Text 1 Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            41 => 
            array (
                'id' => 42,
                'template_group_id' => 20,
                'title' => 'brandLogo1Text2Color',
                'html_label' => 'Brand Logo 1 Text 2 Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            42 => 
            array (
                'id' => 43,
                'template_group_id' => 20,
                'title' => 'brandLogo1Text3Color',
                'html_label' => 'Brand Logo 1 Text 3 Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            43 => 
            array (
                'id' => 44,
                'template_group_id' => 20,
                'title' => 'brandLogo2',
                'html_label' => 'Brand Logo 2',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            44 => 
            array (
                'id' => 45,
                'template_group_id' => 20,
                'title' => 'brandLogo2Text1',
                'html_label' => 'Brand Logo 2 Text 1',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            45 => 
            array (
                'id' => 46,
                'template_group_id' => 20,
                'title' => 'brandLogo2Text2',
                'html_label' => 'Brand Logo 2 Text 2',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            46 => 
            array (
                'id' => 47,
                'template_group_id' => 20,
                'title' => 'brandLogo2TextColor',
                'html_label' => 'Brand Logo 2 Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            47 => 
            array (
                'id' => 48,
                'template_group_id' => 20,
                'title' => 'brandLogo3',
                'html_label' => 'Brand Logo 3',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            48 => 
            array (
                'id' => 49,
                'template_group_id' => 20,
                'title' => 'brandLogo3Text',
                'html_label' => 'Brand Logo 3 Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            49 => 
            array (
                'id' => 50,
                'template_group_id' => 20,
                'title' => 'brandLogo3TextColor',
                'html_label' => 'Brand Logo 3 Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            50 => 
            array (
                'id' => 51,
                'template_group_id' => 20,
                'title' => 'brandLogo4',
                'html_label' => 'Brand Logo 4',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            51 => 
            array (
                'id' => 52,
                'template_group_id' => 20,
                'title' => 'brandLogo4Text',
                'html_label' => 'Brand Logo 4 Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            52 => 
            array (
                'id' => 53,
                'template_group_id' => 20,
                'title' => 'brandLogo4TextColor',
                'html_label' => 'Brand Logo 4 Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            53 => 
            array (
                'id' => 54,
                'template_group_id' => 20,
                'title' => 'brandLogo5',
                'html_label' => 'Brand Logo 5',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            54 => 
            array (
                'id' => 55,
                'template_group_id' => 20,
                'title' => 'shot3',
                'html_label' => 'Shot 3',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            55 => 
            array (
                'id' => 56,
                'template_group_id' => 20,
                'title' => 'shot3TextLeft',
                'html_label' => 'Shot 3 Text Left',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            56 => 
            array (
                'id' => 57,
                'template_group_id' => 20,
                'title' => 'shot3TextRight',
                'html_label' => 'Shot 3 Text Right',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            57 => 
            array (
                'id' => 58,
                'template_group_id' => 20,
                'title' => 'shot4SizeS',
                'html_label' => 'Shot 4 Size S',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            58 => 
            array (
                'id' => 59,
                'template_group_id' => 20,
                'title' => 'shot4SizeM',
                'html_label' => 'Shot 4 Size M',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            59 => 
            array (
                'id' => 60,
                'template_group_id' => 20,
                'title' => 'shot4SizeL',
                'html_label' => 'Shot 4 Size L',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            60 => 
            array (
                'id' => 61,
                'template_group_id' => 20,
                'title' => 'shot4SizeXL',
                'html_label' => 'Shot 4 Size XL',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            61 => 
            array (
                'id' => 62,
                'template_group_id' => 20,
                'title' => 'shot4Logo',
                'html_label' => 'Shot 4 Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            62 => 
            array (
                'id' => 63,
                'template_group_id' => 20,
                'title' => 'shot4Image',
                'html_label' => 'Shot 4 Image',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            63 => 
            array (
                'id' => 64,
                'template_group_id' => 20,
                'title' => 'shot5BrandLogo',
                'html_label' => 'Shot 5 Brand Logo',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            64 => 
            array (
                'id' => 65,
                'template_group_id' => 20,
                'title' => 'shot5BrandTextLine1',
                'html_label' => 'Shot 5 Brand Text Line 1',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            65 => 
            array (
                'id' => 66,
                'template_group_id' => 20,
                'title' => 'shot5BrandTextLine2',
                'html_label' => 'Shot 5 Brand Text Line 2',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            66 => 
            array (
                'id' => 67,
                'template_group_id' => 20,
                'title' => 'shot5BrandTextColor',
                'html_label' => 'Shot 5 Brand Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            67 => 
            array (
                'id' => 68,
                'template_group_id' => 20,
                'title' => 'shot5Image',
                'html_label' => 'Shot 5 Image',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            68 => 
            array (
                'id' => 69,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice1',
                'html_label' => 'Shot 5 Color Choice 1',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            69 => 
            array (
                'id' => 70,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice2',
                'html_label' => 'Shot 5 Color Choice 2',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            70 => 
            array (
                'id' => 71,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice3',
                'html_label' => 'Shot 5 Color Choice 3',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            71 => 
            array (
                'id' => 72,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice4',
                'html_label' => 'Shot 5 Color Choice 4',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            72 => 
            array (
                'id' => 73,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice5',
                'html_label' => 'Shot 5 Color Choice 5',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            73 => 
            array (
                'id' => 74,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice6',
                'html_label' => 'Shot 5 Color Choice 6',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            74 => 
            array (
                'id' => 75,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice7',
                'html_label' => 'Shot 5 Color Choice 7',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            75 => 
            array (
                'id' => 76,
                'template_group_id' => 20,
                'title' => 'shot5ColorChoice8',
                'html_label' => 'Shot 5 Color Choice 8',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            76 => 
            array (
                'id' => 77,
                'template_group_id' => 20,
                'title' => 'shot6Text',
                'html_label' => 'Shot 6 Text',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            77 => 
            array (
                'id' => 78,
                'template_group_id' => 20,
                'title' => 'shot6Image',
                'html_label' => 'Shot 6 Image',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            78 => 
            array (
                'id' => 79,
                'template_group_id' => 20,
                'title' => 'shot6TShirtColor1',
                'html_label' => 'Shot 6 T-shirt Color 1',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            79 => 
            array (
                'id' => 80,
                'template_group_id' => 20,
                'title' => 'shot6TShirtColor2',
                'html_label' => 'Shot 6 T-shirt Color 2',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            80 => 
            array (
                'id' => 81,
                'template_group_id' => 20,
                'title' => 'shot6TShirtColor3',
                'html_label' => 'Shot 6 T-shirt Color 3',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            81 => 
            array (
                'id' => 82,
                'template_group_id' => 20,
                'title' => 'shot6TShirtColor4',
                'html_label' => 'Shot 6 T-shirt Color 4',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            82 => 
            array (
                'id' => 83,
                'template_group_id' => 20,
                'title' => 'shot7TShirt1Text1',
                'html_label' => 'Shot 7 T-shirt 1 Text 1',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            83 => 
            array (
                'id' => 84,
                'template_group_id' => 20,
                'title' => 'shot7TShirt1Text2',
                'html_label' => 'Shot 7 T-shirt 1 Text 2',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            84 => 
            array (
                'id' => 85,
                'template_group_id' => 20,
                'title' => 'shot7TShirt1TextColor',
                'html_label' => 'Shot 7 T-shirt 1 Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            85 => 
            array (
                'id' => 86,
                'template_group_id' => 20,
                'title' => 'shot7TShirtColor1',
                'html_label' => 'Shot 7 T-shirt Color 1',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            86 => 
            array (
                'id' => 87,
                'template_group_id' => 20,
                'title' => 'shot7TShirt1Image',
                'html_label' => 'Shot 7 T-shirt 1 Image',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            87 => 
            array (
                'id' => 88,
                'template_group_id' => 20,
                'title' => 'shot7TShirt2Text1',
                'html_label' => 'Shot 7 T-shirt 2 Text 1',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            88 => 
            array (
                'id' => 89,
                'template_group_id' => 20,
                'title' => 'shot7TShirt2Text2',
                'html_label' => 'Shot 7 T-shirt 2 Text 2',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            89 => 
            array (
                'id' => 90,
                'template_group_id' => 20,
                'title' => 'shot7TShirt2TextColor',
                'html_label' => 'Shot 7 T-shirt 2 Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            90 => 
            array (
                'id' => 91,
                'template_group_id' => 20,
                'title' => 'shot7TShirtColor2',
                'html_label' => 'Shot 7 T-shirt Color 2',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            91 => 
            array (
                'id' => 92,
                'template_group_id' => 20,
                'title' => 'shot7TShirt2Image',
                'html_label' => 'Shot 7 T-shirt 2 Image',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            92 => 
            array (
                'id' => 93,
                'template_group_id' => 20,
                'title' => 'shot7TShirt3Text1',
                'html_label' => 'Shot 7 T-shirt 3 Text 1',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            93 => 
            array (
                'id' => 94,
                'template_group_id' => 20,
                'title' => 'shot7TShirt3Text2',
                'html_label' => 'Shot 7 T-shirt 3 Text 2',
                'type' => 'Text',
                'mandatory' => 0,
                'validation_rules' => 'max:50',
            ),
            94 => 
            array (
                'id' => 95,
                'template_group_id' => 20,
                'title' => 'shot7TShirt3TextColor',
                'html_label' => 'Shot 7 T-shirt 3 Text Color',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            95 => 
            array (
                'id' => 96,
                'template_group_id' => 20,
                'title' => 'shot7TShirtColor3',
                'html_label' => 'Shot 7 T-shirt Color 3',
                'type' => 'Color Picker',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            96 => 
            array (
                'id' => 97,
                'template_group_id' => 20,
                'title' => 'shot7TShirt3Image',
                'html_label' => 'Shot 7 T-shirt 3 Image',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            97 => 
            array (
                'id' => 98,
                'template_group_id' => 20,
                'title' => 'shot8Slide1Left',
                'html_label' => 'Shot 8 Slide 1 Left',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            98 => 
            array (
                'id' => 99,
                'template_group_id' => 20,
                'title' => 'shot8Slide1Center',
                'html_label' => 'Shot 8 Slide 1 Center',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            99 => 
            array (
                'id' => 100,
                'template_group_id' => 20,
                'title' => 'shot8Slide1Right',
                'html_label' => 'Shot 8 Slide 1 Right',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            100 => 
            array (
                'id' => 101,
                'template_group_id' => 20,
                'title' => 'shot8Slide2Left',
                'html_label' => 'Shot 8 Slide 2 Left',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            101 => 
            array (
                'id' => 102,
                'template_group_id' => 20,
                'title' => 'shot8Slide2Center',
                'html_label' => 'Shot 8 Slide 2 Center',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            102 => 
            array (
                'id' => 103,
                'template_group_id' => 20,
                'title' => 'shot8Slide2Right',
                'html_label' => 'Shot 8 Slide 2 Right',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            103 => 
            array (
                'id' => 104,
                'template_group_id' => 20,
                'title' => 'shot8Slide3Left',
                'html_label' => 'Shot 8 Slide 3 Left',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            104 => 
            array (
                'id' => 105,
                'template_group_id' => 20,
                'title' => 'shot8Slide3Center',
                'html_label' => 'Shot 8 Slide 3 Center',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            105 => 
            array (
                'id' => 106,
                'template_group_id' => 20,
                'title' => 'shot8Slide3Right',
                'html_label' => 'Shot 8 Slide 3 Right',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            106 => 
            array (
                'id' => 107,
                'template_group_id' => 20,
                'title' => 'shot8Slide4Left',
                'html_label' => 'Shot 8 Slide 4 Left',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            107 => 
            array (
                'id' => 108,
                'template_group_id' => 20,
                'title' => 'shot8Slide4Center',
                'html_label' => 'Shot 8 Slide 4 Center',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
            108 => 
            array (
                'id' => 109,
                'template_group_id' => 20,
                'title' => 'shot8Slide4Right',
                'html_label' => 'Shot 8 Slide 4 Right',
                'type' => 'File',
                'mandatory' => 0,
                'validation_rules' => '',
            ),
        ));
        
        
    }
}