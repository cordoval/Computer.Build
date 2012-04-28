watch( '(.*\.feature)$' )  {|md| system("behat -fprogress #{md[1]}") }
watch( '(.*\.php)$' )  {|md| system("phpunit") }
