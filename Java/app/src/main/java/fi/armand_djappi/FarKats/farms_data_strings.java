package fi.armand_djappi.FarKats;

public class farms_data_strings {

    private String left;
    private String right;
    private String centre;

    public farms_data_strings(String left, String right, String centre) {
        this.left = left;
        this.right = right;
        this.centre = centre;
    }

    public String getLeft() {
       return left;
    }

    public String getRight() {
        return right;
    }

    public String getCentre() {
        return centre;
    }
}
