module.exports = function(grunt) {

    var src = 'src/',  //开发目录
        dest = 'dest/'; //发布目录

    grunt.initConfig({

        //打包之前先清除
        clean: {
            release: ['dest', '.temp']
        },

        // 复制一份static至dest
        copy: {
            html: {
                expand: true,
                cwd: src,
                src: ['**'],
                dest: dest
            }
        },

        //压缩CSS
        cssmin: {
            compress: {
                files: {
                    'dest/test.min.css': [
                        "src/global.css",
                        "src/index.css"
                    ]
                }
            }
        },
        //压缩图片
        imagemin: {
            prod: {
                options: {
                    optimizationLevel: 7,
                    pngquant: true
                },
                files: [
                    {expand: true, cwd: 'dist/html', src: ['images/*.{png,jpg,jpeg,gif,webp,svg}'], dest: 'dist/html'}
                ]
            }
        },

        //合并文件
        concat: {
            options: {
                separator: '\n'
            }
        },

        //JS压缩
        uglify: {
            options: {
// sourceMap: true,
                "DEBUG": true
            }
        },



    });

    // 加载提供"uglify"任务的插件
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    // 默认任务
    grunt.registerTask('default', ['clean','uglify','copy','cssmin']);











};