; Aa1Bb2Cc3Dd4Ee5Ff6Gg7Hh8\

                DOSSEG
                .MODEL SMALL
; Memesan penempatan stack dan jumlah memori

                .STACK 256
                .DATA


Karakter   MACRO
            
            MOV DL,41H
            MOV CX,8
Ulang:       INT 21H
            INC DL
            PUSH DX
            ADD DL,1FH
            INT 21H
            SUB DL,30H
            INT 21H
            POP DX
            LOOP Ulang
            ENDM


Code_seg    Segment
            Assume CS:Code_seg
            ORG 100H

Mulai :    MOV AH,02H
            Karakter

            MOV AH,4CH
            INT 21H
Code_seg    ends
            end Mulai