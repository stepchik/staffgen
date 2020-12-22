for i in $(git status --porcelain | awk '{print $2}'); do
    php /Users/stepchik/WebProject/staffgen/index.php ichange <argv1> <argv2> "$i";
    php /Users/stepchik/WebProject/staffgen/index.php irename-middle <argv1> <argv2> "$i";
done
