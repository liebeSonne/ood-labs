package view;

import javax.swing.*;

public class MenuBar extends JMenuBar {

    public MenuBar() {
        super();
        this.initComponents();
    }

    private void initComponents() {
        this.initMenuFile();
        this.initMenuHome();
        this.initMenuInsert();
        this.initMenuView();
        this.initMenuFormat();
    }

    private void initMenuFile() {
        JMenu menuFile = new JMenu("File");
        this.add(menuFile);
    }

    private void initMenuHome() {
        JMenu menuHome = new JMenu("Home");
        this.add(menuHome);
    }

    private void initMenuInsert() {
        JMenu menuInsert = new JMenu("Insert");
        this.add(menuInsert);
    }

    private void initMenuView() {
        JMenu menuView = new JMenu("View");
        this.add(menuView);
    }

    private void initMenuFormat() {
        JMenu menuFormat = new JMenu("Format");
        this.add(menuFormat);
    }
}
