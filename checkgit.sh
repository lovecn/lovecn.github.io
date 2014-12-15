 #!/bin/sh
   # <oldrev> <newrev> <refname>
   # update a blame tree
   while read oldrev newrev ref
   do
       # php -l
       echo '==== Running PHP linter ====';
       for file in `git diff --name-only $oldrev $newrev|grep '.php$'`;
       do
          echo ---- $file ----;
          lstree=`git ls-tree $newrev $file`;
          if [ "" =  "$lstree" ] ; then echo "   Delete"; continue; fi
          ##echo "   $lstree";
          objType=`echo $lstree |awk '{print $2}'`;
          objHash=`echo $lstree |awk '{print $3}'`;
          git cat-file $objType $objHash|php -l;
          passed=$?;
          if [ "0" != $passed ] ; then exit $passed; fi;
      done
  done
