; Nama  : Muhammad Faqih
; NIM   : 2020230032
; Program mencetak kalimat dengan INT21H SERVICE 02H
; Program Konstan.asm

Register_cx EQU 04H
Reg_dl EQU 00H

Code_seg Segment
         Assume cs:Code_seg
         org 100H

Mulai:   Jmp Cetak_string

;------------------------------------------------------------
Teks db 'Mari Kita Belajar Bahasa Assembly ',0
;------------------------------------------------------------

Cetak_string:   MOV BX,04H
                XOR BX,BX
Dari_loop:      MOV DL, TEKS[BX]
                CMP DL,Reg_dl
                JZ Selesai
                CALL Cetak_Karakter
                INC BX
                JMP Dari_loop
Selesai:        MOV AX,4C00H
                INT 21H

; Prosedur Cetak Karaker
Cetak_Karakter  PROC NEAR
                PUSH AX
                MOV AH,02H
                INT 21H
                POP AX
                RET
Cetak_Karakter  ENDP
Code_seg        ENDS
                END Mulai