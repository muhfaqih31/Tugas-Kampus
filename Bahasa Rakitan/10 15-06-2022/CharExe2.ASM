Counter_C EQU 05H
Karakter_A EQU 41H

Bag_Program Segment
            Assume CS:Bag_Program
mulai :     Mov cx, Counter_C
            Mov ah,02H
            mov dl, karakter_A
Dari_loop : int 21H
            inc dl
            Loop Dari_loop
            Mov ah,4cH
            int 21H
Bag_Program ends
end mulai