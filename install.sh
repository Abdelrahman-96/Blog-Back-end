# Colors
NOCOLOR='\033[0m'
RED='\033[0;91m'
Green='\033[0;92m'
Yellow='\033[0;93m'
Blue='\033[0;94m'
Magenta='\033[0;95m'
Cyan='\033[0;96m'
White='\033[0;97m'


BRED='\033[7;91m'
BGreen='\033[7;92m'
BYellow='\033[7;93m'
BBlue='\033[7;94m'
BMagenta='\033[7;95m'
BCyan='\033[7;96m'
BWhite='\033[7;97m'

# Make Symbolic link

printf "${Green}making Symbolic Link ${NOCOLOR}\n"
printf "${RED}php ${Cyan}artisan ${White}storage:link${NOCOLOR}\n"

php artisan storage:link

if [ $? -eq 0 ]; then
    printf "\a${BWhite}Symbolic Link Made Successfully${NOCOLOR}\n"
fi
# Make global Chmod

printf "${Green}Making Chmod to be ${RED} 777 ${NOCOLOR}\n"
printf "${RED}chmod ${Cyan}777 ${White}storage -R ${Yellow}* ${NOCOLOR}\n"

sudo chmod 777 storage -R *

if [ $? -eq 0 ]; then
    printf "\a${BWhite}storage directory can be accessed successfully now Success${NOCOLOR}\n"
fi

sudo timedatectl set-timezone Africa/Cairo

printf "${Green}Install Passport ${NOCOLOR}\n"
printf "${RED}composer ${NOCOLOR}install${NOCOLOR}\n"

composer install

printf "${RED}php ${Cyan}artisan ${White}migrate${NOCOLOR}\n"

php artisan migrate:fresh

printf "${RED}php ${Cyan}artisan ${White}passport:install${NOCOLOR}\n"

php artisan passport:install

printf "${RED}php ${Cyan}artisan ${White}passport:keys${NOCOLOR}\n"

php artisan passport:keys

printf "${RED}php ${Cyan}artisan ${White}passport:client --personal${NOCOLOR}\n"

php artisan passport:client --personal

printf "${RED}php ${Cyan}artisan ${White}db:seed${NOCOLOR}\n"

php artisan db:seed

