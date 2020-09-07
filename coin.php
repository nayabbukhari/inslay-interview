/*
Given a value N, if we want to make change for N cents, and we have infinite supply of each of S = { S1, S2, .. , Sm} valued coins, how many ways can we make the change? The order of coins doesn’t matter.
For example, for N = 4 and S = {1,2,3}, there are four solutions: {1,1,1,1},{1,1,2},{2,2},{1,3}. So output should be 4. For N = 10 and S = {2, 5, 3, 6}, there are five solutions: {2,2,2,2,2}, {2,2,3,3}, {2,2,6}, {2,3,5} and {5,5}. So the output should be 5.

Recommended: Please solve it on “PRACTICE ” first, before moving on to the solution.
1) Optimal Substructure
To count the total number of solutions, we can divide all set solutions into two sets.
1) Solutions that do not contain mth coin (or Sm).
2) Solutions that contain at least one Sm.
Let count(S[], m, n) be the function to count the number of solutions, then it can be written as sum of count(S[], m-1, n) and count(S[], m, n-Sm).

Therefore, the problem has optimal substructure property as the problem can be solved using solutions to subproblems.

2) Overlapping Subproblems
Following is a simple recursive implementation of the Coin Change problem. The implementation simply follows the recursive structure mentioned above.
*/

function count_change ($money, $coins) {
    $count = sizeof($coins);  
    $table = array_fill(0, $money + 1, NULl);   
    $table[0] = 1; 
    
    for($i = 0; $i < $count; $i++) 
        for($j = $coins[$i]; $j <= $money; $j++) 
        $table[$j] += $table[$j - $coins[$i]]; 
    
    return $table[$money]; 
}
  
// Driver Code 
$x = count_change(10, array(5,2,3));
echo $x; 
