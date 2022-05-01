package com.lab9v1.view;

import com.lab9v1.controller.MainController;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class App {
    private JButton addNewButton;
    private JButton deleteSelectedButton;
    private JTextField amplitudeTextField;
    private JList harmonicsList;
    private JTabbedPane tabbedPane1;
    private JTable table;
    private JRadioButton sinRadioButton;
    private JRadioButton cosRadioButton;
    private JTextField frequencyTextField;
    private JTextField phaseTextField;
    private JPanel mainPanel;
    private ButtonGroup formulaButtonGroup;

    private MainController controller;

    public App(MainController controller) {
        this.controller = controller;

        addNewButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                onAddNewButton();
            }
        });
        deleteSelectedButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                onDeleteSelectedButton();
            }
        });
    }

    public JPanel getMainPanel() {
        return mainPanel;
    }

    private void onAddNewButton() {
        JDialog dialog = new AddNewHarmonic(controller);
        dialog.pack();
        dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
        dialog.setVisible(true);
     }

     private void onDeleteSelectedButton() {

     }
}
