.MODEL SMALL 
.STACK 100H 
.DATA 

Pertanyaan DB 'Jawablah pertanyaan dibawah ini : ', 13,10
           DB 'Apakah anda seorang Mahasiswa (Y/T) ? ',13,10
           DB 'Jawaban anda : $'

Jawaban1 DB 'Anda adalah seorang mahasiswa ',13,10,'$'
Jawaban2 DB 'Anda adalah seorang mahasiswi ',13,10,'$'

.CODE 

Code_Seg Segment
Assume CS:Code_Seg
ORG 100H
JMP MUlai


MULAI PROC FAR 
 MOV AX,@DATA 
 MOV DS,AX 

LEA DX,Pertanyaan
MOV AH,09H
INT 21H

Perulangan:
MOV AH,01H
INT 21H
CMP AL,'Y'
JE Siswa
CMP AL,'y'
JE Siswa
CMP AL,'t'
JE Siswi
CMP AL,'T'
JE Siswi
JNE Perulangan

Siswa:
MOV AH,02H
MOV DL,0aH
INT 21H
MOV AH,09H
LEA DX,Jawaban1
INT 21H
JMP Selesai

Siswi:
MOV AH,02H
MOV DL,0aH
INT 21H
MOV AH,09H
LEA DX,Jawaban2
INT 21H
JMP Selesai



Selesai:
MOV AX,4C00H
INT 21H


Code_Seg ENDS

MULAI ENDP 
END MULAI 


