// Constantes e funções
module.exports = function (grunt) {

    // Configuração do projeto
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd/mm/yyyy HH:mm:ss") %> */\n',
                preserveComments: 'all' //Manter todos os comentários dos aquivos .JS
            },

            JAVASCRIPT: {
                files: {
                    'public_html/assets/appv2.min.js':
                        [
                            'node_modules/jquery/dist/jquery.min.js',
                            'node_modules/popper.js/dist/umd/popper.min.js',
                            'node_modules/bootstrap/dist/js/bootstrap.min.js',
                            'beta/js/bootstrap-autocomplete.min.js',
                            'node_modules/jquery-ui-dist/jquery-ui.min.js',
                            'node_modules/jquery.redirect/jquery.redirect.js',
                            'node_modules/bootstrap-table/dist/bootstrap-table.min.js',
                            'node_modules/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js',
                            'node_modules/bootstrap-table/dist/locale/bootstrap-table-pt-BR.min.js',
                            'node_modules/bootstrap-table/dist/extensions/multiple-sort/bootstrap-table-multiple-sort.min.js',
                            'node_modules/bgaze-bootstrap4-dialogs/dist/bootstrap4-dialogs.min.js',
                            'node_modules/@fortawesome/fontawesome-free/js/all.min.js',
                            'node_modules/jquery-mask-plugin/dist/jquery.mask.js',
                            'node_modules/bootstrap-fileinput/js/fileinput.min.js',
                            'node_modules/bootstrap-fileinput/js/plugins/piexif.min.js',
                            'node_modules/bootstrap-fileinput/js/plugins/sortable.min.js',
                            'node_modules/bootstrap-fileinput/js/plugins/purify.min.js',
                            'node_modules/bootstrap-fileinput/themes/fa/theme.min.js',
                            'node_modules/bootstrap-fileinput/js/locales/pt-BR.js',



                            'node_modules/pretty-print-json/dist/pretty-print-json.min.js',
                            'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
                            'node_modules/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js',
                            'node_modules/clockpicker/dist/bootstrap-clockpicker.min.js',
                            'vendor/kartik-v/bootstrap-tabs-x/js/bootstrap-tabs-x.min.js',
                            'node_modules/trumbowyg/dist/trumbowyg.min.js',
                            'node_modules/trumbowyg/dist/langs/pt_br.min.js',
                            'node_modules/moment/min/moment.min.js',
                            'node_modules/iframe-resizer/js/iframeResizer.min.js',
                            'node_modules/iframe-resizer/js/iframeResizer.contentWindow.min.js',
                            'node_modules/intro.js/minified/intro.min.js',
                            'node_modules/jquery-toast-plugin/dist/jquery.toast.min.js',
                            'node_modules/uppy/dist/uppy.min.js',
                            'node_modules/@uppy/locales/dist/pt_BR.min.js',
                            'node_modules/tinymce/tinymce.min.js',
                            'node_modules/colorthief/dist/color-thief.umd.js',
                            'node_modules/jquery-validation/dist/jquery.validate.min.js',
                            'node_modules/jquery-validation/dist/localization/messages_pt_BR.min.js',
                            'node_modules/countup.js/dist/countUp.umd.js',
                            'node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js',
                            'node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js',
                            'node_modules/moment/locale/pt-br.js',
                            'node_modules/aos/dist/aos.js',
                            'node_modules/sweetalert2/dist/sweetalert2.min.js',

                            'node_modules/fullcalendar/dist/fullcalendar.min.js',
                            'node_modules/fullcalendar/dist/locale/pt-br.js',

                            'include/app.js',

                        ]
                }
            }
        },
        cssmin: {

            CSS: {
                files: {
                    'public_html/assets/appv2.min.css': [
                        'node_modules/bootstrap/dist/css/bootstrap.min.css',
                        'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
                        'node_modules/jquery-ui-dist/jquery-ui.min.css',
                        'node_modules/bootstrap-table/dist/bootstrap-table.min.css',
                        'node_modules/pretty-print-json/dist/pretty-print-json.css',
                        'node_modules/bootstrap-fileinput/css/fileinput.min.css',



                        'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
                        'node_modules/clockpicker/dist/bootstrap-clockpicker.min.css',
                        'vendor/kartik-v/bootstrap-tabs-x/css/bootstrap-tabs-x.min.css',
                        'node_modules/trumbowyg/dist/ui/trumbowyg.min.css',
                        'node_modules/intro.js/minified/introjs.min.css',
                        'node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',


                        'node_modules/bootstrap4-toggle/css/bootstrap4-toggle.min.css',
                        'node_modules/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css',
                        'node_modules/aos/dist/aos.css',
                        'node_modules/sweetalert2/dist/sweetalert2.min.css',

                        'node_modules/fullcalendar/dist/fullcalendar.min.css',

                        'include/app.css',

                    ]
                }
            }
        },
        copy: {
            main: {
                files: [
                    // includes files within path


                    {
                        src: ['node_modules/trumbowyg/dist/ui/icons.svg'],
                        dest: 'public_html/assets/svg/icons.svg',
                        filter: 'isFile'
                    },
                    {
                        expand: true,
                        flatten: true,
                        src: ['node_modules/@fortawesome/fontawesome-free/webfonts/**'],
                        dest: 'public_html/webfonts/',
                        filter: 'isFile'
                    },
                    {
                        expand: true,
                        flatten: true,
                        src: ['node_modules/@fortawesome/fontawesome-free/webfonts/**'],
                        dest: 'public_html/php/webfonts/',
                        filter: 'isFile'
                    },
                ],
            },
        },
        watch: {
            files: ['**/*'],
            tasks: ['cssmin'],
        },

    });

    // tarefas do usuário
    grunt.loadNpmTasks('grunt-contrib-uglify-es');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Tarefas padrão comando grunt --force
    grunt.registerTask('default', ['uglify', 'cssmin', 'copy']);

};
