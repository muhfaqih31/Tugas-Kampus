; Program Macro.ASM
; Tujuan mempelajari penggunaan Macro
Karakter1   MACRO
            MOV AH,02H
            MOV DL,31H
            INT 21H
            ENDM

karakter2   MACRO
            MOV AH,02H
            MOV DL,32H
            INT 21H
            ENDM
Code_seg    Segment
            Assume CS:Code_seg
            ORG 100H

Mulai :     MOV AH,02H
            MOV DL,41H
            INT 21H
            Karakter1
            MOV DL,41H
            INT 21H
            Karakter2
            MOV AH,4CH
            INT 21H
Code_seg    ends
            end Mulai