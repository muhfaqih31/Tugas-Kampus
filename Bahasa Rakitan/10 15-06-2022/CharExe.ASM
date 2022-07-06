; Nama file : Charexe.ASM
; Pembuatan file berekstensi .EXE melalui Pemrograman Mode Ideal
; definisi nama konstanta yang digunakan
Karakter_A  EQU 41H
Counter_CX  EQU 5H
;

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
                MOV DL,Karakter_A

Dari_loop:      INT 21H
                INC DL
                LOOP Dari_Loop
                MOV AH,4CH
                INT 21H
END Isi_Program
                