Code_seg    Segment
            ASSUME CS:Code_seg
            ORG 100H
mulai:      MOV CX,5
            MOV AH,2
            MOV DL,41H
Dari_loop:  INT 21H
            INC DL
            LOOP Dari_loop
            MOV AX,4C00H
            INT 21H
Code_seg    ENDS
            END mulai
