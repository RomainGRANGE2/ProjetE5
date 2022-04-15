pipeline {
  agent any
  environment {
    HOME = '.'
  }
  stages {
    stage('Test') {
      agent {
        docker {
          image 'centos-laravel:latest'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        sh "composer update"
        sh "php artisan test"
      }
    }
    stage('Deploy') {
      agent {
        docker {
          image 'centos-laravel:latest'
          args '-v /etc/passwd:/etc/passwd -v /etc/group:/etc/group'
        }
      }
      steps {
        withCredentials([usernamePassword(credentialsId: 'grangeshell', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')])
         {
          sh "echo USERNAME     = $USERNAME"
          sh "echo PASSWORD     = $PASSWORD"
          sh "echo WORKSPACE    = ${env.WORKSPACE}"
          sh "/usr/bin/sshpass -p $PASSWORD /usr/bin/scp -o StrictHostKeyChecking=no -r ${env.WORKSPACE}/* $USERNAME@wordpress.grange.etu.lmdsio.com:/private"
        }
      }
    }
  }
}
