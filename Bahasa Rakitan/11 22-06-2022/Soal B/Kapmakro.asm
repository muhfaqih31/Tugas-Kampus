; Nama      : Muhammad Faqih
; NIM       : 2020230032
; Tanggal   : Rabu, 22 Juni 2022


                DOSSEG
                .MODEL SMALL
; Memesan penempatan stack dan jumlah memori

                .STACK 256
                .DATA

; Memesan tempat program untuk menaruh susunan program
; Definisikan counter
Counter_CX EQU 8H

karakter   MACRO
            MOV DL,61H
Ulang:      INT 21H
            INC DL
            PUSH DX
            SUB DL,31H
            INT 21H
            ADD DL,10H
            INT 21H
            POP DX
            LOOP Ulang
            ENDM

Code_seg    Segment
            Assume CS:Code_seg
            ORG 100H

Mulai :     MOV CX, Counter_CX
            MOV AH,2 
            karakter
            MOV AH,4CH
            INT 21H
            
Code_seg    ends
            end Mulai