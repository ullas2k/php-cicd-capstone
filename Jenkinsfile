pipeline {
    agent any

    environment {
        AWS_REGION = 'us-east-2'
        ECR_REPO = '995938833134.dkr.ecr.us-east-2.amazonaws.com/php-app'
        IMAGE_TAG = "${BUILD_NUMBER}"
    }

    stages {

        stage('Clone') {
            steps {
                git 'https://github.com/ullas2k/php-cicd-capstone.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t php-app:${IMAGE_TAG} .'
            }
        }

        stage('Login to ECR') {
            steps {
                withCredentials([[$class: 'AmazonWebServicesCredentialsBinding', credentialsId: 'aws-creds']]) {
                    sh '''
                    aws ecr get-login-password --region $AWS_REGION | \
                    docker login --username AWS --password-stdin $ECR_REPO
                    '''
                }
            }
        }

        stage('Push Image') {
            steps {
                sh '''
                docker tag php-app:${IMAGE_TAG} $ECR_REPO:${IMAGE_TAG}
                docker push $ECR_REPO:${IMAGE_TAG}
                '''
            }
        }
    }
}
