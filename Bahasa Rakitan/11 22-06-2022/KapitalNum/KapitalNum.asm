;Nama   	: Muhamamd Faqih
;NIM    	: 2020230032
;Tanggal	: Rabu, 22 Juni 2022

Karakter  EQU 41H
Angka EQU 31H
Counter_CX  EQU 0BH


                DOSSEG
                .MODEL SMALL
; Memesan penempatan stack dan jumlah memori

                .STACK 256
                .DATA

; Memesan tempat program untuk menaruh susunan program

                .CODE
                ORG 100H
Isi_program:     

                MOV CX,Counter_CX
                MOV AH,2
                MOV DL,Karakter

Dari_loop:      INT 21H
                INC DL
                PUSH DX
                MOV DL, Angka
                INT 21H
                POP DX
                LOOP Dari_Loop
                MOV AH,4CH
                INT 21H
END Isi_Program
                