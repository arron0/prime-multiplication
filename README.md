# prime-multiplication

Project runs in docker environment.

To run the project just mark run.sh as executable if necessary: `chmod +x run.sh` and than run it with argument specifying the size of the table (number of prime numbers required in the table): `./run.sh 5`

Sample output:
```
X       2       3       5       7       11
2       4       6       10      14      22
3       6       9       15      21      33
5       10      15      25      35      55
7       14      21      35      49      77
11      22      33      55      77      121
```

Output is lacking more formatting, I don't thing it is the merit of the task. Moreover with larger sizes it would be better to add the option to save the output to, for example, csv file.
